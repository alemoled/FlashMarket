// TODO: Json "products", cada unidad estaria almacenado tal que product:{title,description,price,image,category,store} */
import puppeteer from "puppeteer-extra";
import StealthPlugin from "puppeteer-extra-plugin-stealth";
import * as cheerio from "cheerio";
import mysql from "mysql2/promise";
// *CONSTANTES GLOBALES
//Iniciamos el navegador bot y configuramos para que el bot no sea automaticamente bloqueado y podamos trabajar sin abrir un navegador
puppeteer.use(StealthPlugin());
const browser = await puppeteer.launch({
  headless: false,
  slowMo: 200
});
// const configBBDD = mysql.createPool({
//   host: "localhost",
//   user: "root",
//   password: "",
//   database: "flashmarket",
// });
// Funcion general para que el navegador baje hasta el fondo de la pagina y asi cargue los elemento dinamicos
async function autoScroll(page) {
  await page.evaluate(async () => {
    await new Promise((resolve) => {
      let totalHeight = 0;
      const distance = 300;
      const timer = setInterval(() => {
        const scrollHeight = document.body.scrollHeight;
        window.scrollBy(0, distance);
        totalHeight += distance;
        if (totalHeight >= scrollHeight) {
          clearInterval(timer);
          resolve();
        }
      }, 100);
    });
  });
}
// *Funcion para que en DIA se meta en la pag de producto y tome su descripcion,si no toma el cacho de texto en sus migas de pan
async function getDescription(productURL, browser) {
  const productPage = await browser.newPage();
  await productPage.setUserAgent(
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/122.0.0.0 Safari/537.36"
  );
  try {
    await productPage.goto(productURL, {
      waitUntil: "networkidle2",
      timeout: 60000,
    });
    const description = await productPage.evaluate(() => {
      const productContainer = document.getElementById("details-tabs-pane-1");
      return (
        productContainer.querySelector("div div p span")?.textContent.trim() ||
        "sin descripcion"
      );
    });
    await productPage.close();
    return description;
  } catch (error) {
    console.error(
      `Error al obtener la descripción de ${productURL}: ${error.message}`
    );
    await productPage.close();
    return "Error al cargar descripción";
  }
}
//*CASO DIA
async function scrapingMakro(page, browser) {
  await autoScroll(page);
  await new Promise((r) => setTimeout(r, 3000));
  const elementsHandle = await page.evaluateHandle(() => {
    return document.querySelectorAll(".sd-articlecard");
  });
  // Convertir el JSHandle en un array de elementos
  const containers = await elementsHandle.evaluate((element) =>
    Array.from(element).map((el) => el.outerHTML)
  );
  //category
  const resCategory = await page.evaluate(() => {
    return document
      .querySelector(
        ".list-group-item.list-group-item-header.list-group-item-back h1 span"
      )
      .textContent.trim()
      .replace(/\u00A0/g, " ");
  });
  const results = await Promise.all(
    containers.map(async (container) => {
      const $ = cheerio.load(container);
      //title
      const resTitle = $(".title-wrapper h4").text().trim();
      //TODO: Descripcion aqui falta porque debes entrar en cada puta pagina de producto y obtener su info, duro como el solo.IDEA:HACEMOS NUEVA PAGINA,HIJA DE ESTAS PARA NO PERDER LA INFO
      const productURL = "https://tienda.makro.es" + $(".title").attr("href");
      const resDescription = await getDescription(productURL, browser);
      //price
      const resPrice = $(".price-display-main-row .primary span span")
        ? $(".price-display-main-row .primary span span")
            .text()
            .trim()
            .replace(/\u00A0/g, " ")
        : "Precio no encontrado";
      //image
      const resImage =$(".image-container image img").attr("src");
      return {
        title: resTitle,
        description: resDescription,
        price: resPrice,
        image: resImage,
        category: resCategory,
        //store
        store: "Makro",
      };
    })
  );
  const filteredResults = results.filter(
    (product) =>
      product.title &&
      product.description &&
      product.price &&
      product.image &&
      !product.image.includes("undefined")
  );
  return filteredResults;
}
async function insertproductsMakro(products, connection) {
  try {
    for (const product of products) {
      const [rows] = await connection.execute(
        "SELECT id, price FROM products where title=? AND store=?",
        [product.title, product.store]
      );
      if (!rows || rows.length === 0) {
        // *CASO NUEVO PRODUCTO
        await connection.execute(
          "INSERT INTO products (title, description, price, image, category, store) VALUES (?, ?, ?, ?, ?, ?)",
          [
            product.title,
            product.description,
            product.price,
            product.image,
            product.category,
            product.store,
          ]
        );
      } else {
        // *CASO PRODUCTO EXISTENTE.Comprobamos que el precio es igual o se actualizo
        const oldPrice = rows[0].price; //OJO:COMO ID ES UNICA, O HAY 0 O HAY 1 SIEMPRE EN ESTA ARRAY,
        // DONDE ESTA EL PRODUCTO EXISTENTE CUIDAO CON ALTERAR ESTA SUPOSICION
        if (oldPrice !== product.price) {
          await connection.execute(
            "UPDATE products SET price=? WHERE title=? AND store=?",
            [product.price, product.title, product.store]
          );
        }
      }
    }
  } catch (error) {
    console.log("Errores en la metision de products:", error.message);
  } finally {
    if (connection) {
      await connection.release();
      await configBBDD.end();
    }
  }
}
//! MAIN DE SCRAPING
(async () => {
  // const page = await browser.newPage();
  // const connection = await configBBDD.getConnection();
  const URLs = ["https://tienda.makro.es/shop/category/frescos/carne"];
  const productsMakroArray = [];
  for (let i = 0; i < URLs.length; i++) {
    const page = await browser.newPage();
    await page.goto(URLs[i]);
    const productsPage = await scrapingMakro(page, browser);
    productsDiaArray.push(...productsPage);
    await page.close();
  }
  // Hasta aqui el scrapping de Dia, toca meterlo en la bbdd
  // await insertproductsMakro(productsMakroArray, connection);
  console.log(productsMakroArray)
  await browser.close();
  console.log("CULMINO");
})();
