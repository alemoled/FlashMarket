// TODO: Json "products", cada unidad estaria almacenado tal que product:{title,description,price,image,category,store} */
import puppeteer from "puppeteer-extra";
import StealthPlugin from "puppeteer-extra-plugin-stealth";
import * as cheerio from "cheerio";
import mysql from "mysql2/promise";
var cont = 1;
// *CONSTANTES GLOBALES
//Iniciamos el navegador bot y configuramos para que el bot no sea automaticamente bloqueado y podamos trabajar sin abrir un navegador
puppeteer.use(StealthPlugin());
const browser = await puppeteer.launch({
  headless: "new",
});
const configBBDD = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "flashmarket",
});
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
async function getDescription(productURL) {
  try {
    const productPage = await browser.newPage();
    await productPage.setUserAgent(
      "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/122.0.0.0 Safari/537.36"
    );
    await productPage.goto(productURL, {
      waitUntil: "domcontentloaded",
      timeout: 60000,
    });
    await new Promise((resolve) => setTimeout(resolve, 3000)); // Espera 3 segundos
    // await productPage.screenshot({
    //   path: "screenshots/screenshot" + cont + ".png",
    // });
    const description = await productPage.evaluate(() => {
      return (
        // Recoger datos de descripcion
        document
          .querySelector(".nutrition-ingredients__content")
          ?.textContent.trim()
      );
    });
    return description;
  } catch (error) {
    console.error(
      `Error al obtener la descripción de ${productURL}: ${error.message}`
    );
    await productPage.close();
    return "Error al cargar descripción";
  } finally {
    cont++;
  }
}
//*CASO DIA
async function scrapingCarrefour(page, productPage) {
  await autoScroll(page);
  const elementsHandle = await page.evaluateHandle(() => {
    // Tomar contenedores con todos los datos para productos
    return document.querySelectorAll(".product-card-list__item");
  });
  // Convertir el JSHandle en un array de elementos
  const containers = await elementsHandle.evaluate((element) =>
    Array.from(element).map((el) => el.outerHTML)
  );
  //category
  var resCategory = await page.evaluate(() => {
    return document
      .querySelector(".raw-html__category-container h1")
      .textContent.trim()
      .replace(/\s+/g, " ");
  });
  //  Sanear categoria para que coincidan en la BBDD
  if (resCategory == "Aceites y vinagres") {
    resCategory = "Aceites, salsas y especias";
  } else if (resCategory == "\n    Conservas de Carne\n  ") {
    resCategory = "Carne";
  } else if (resCategory.trim() == "Queso Rallado") {
    resCategory = "Charcutería y quesos";
  }else if (resCategory.trim() == "Frutos del Bosque") {
    resCategory = "Frutas";
  }else if (resCategory.trim() == "Listo para beber") {
    resCategory = "Leche, huevos y mantequilla";
  }else if (resCategory.trim() == "Lejías lavadora") {
    resCategory = "Limpieza y hogar";
  }else if (resCategory.trim() == "Conservas de Pescado y Marisco") {
    resCategory = "Pescados y mariscos";
  }else if (resCategory.trim() == "Ensaladas y Verduras Preparadas") {
    resCategory = "Verduras";
  }

  const results = await Promise.all(
    containers.map(async (container) => {
      const $ = cheerio.load(container);
      //title
      const resTitle = $(".product-card__title-link").text().trim();
      //TODO: Descripcion aqui falta porque debes entrar en cada pagina de producto y obtener su info, duro como el solo.IDEA:HACEMOS NUEVA PAGINA,HIJA DE ESTAS PARA NO PERDER LA INFO
      //   Obtener Url de la pagina que tenga la descripcion del producto itinerado
      const productURL =
        "https://www.carrefour.es" +
        $(".product-card__title-link").attr("href");
      if (productURL !== "https://www.carrefour.esundefined")
        var resDescription = await getDescription(productURL, productPage);
        if(typeof resDescription== "undefined") resDescription=resTitle
      //price
      const resPrice = $(".product-card__price").text().trim();
      // .replace(/\u00A0/g, " "); OJO:METER ESTO SI TENEMOS QUE SANEAR EL TEXTO
      //image
      const resImage = $(".product-card__image").attr("src");
      return {
        title: resTitle,
        description: resDescription,
        price: resPrice,
        image: resImage,
        category: resCategory,
        //store
        store: "Carrefour",
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
async function insertproductsCarrefour(products, connection) {
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
  const connection = await configBBDD.getConnection();
  const URLs = [
    "https://www.carrefour.es/supermercado/la-despensa/alimentacion/aceites-y-vinagres/cat20066/c",
    "https://www.carrefour.es/supermercado/la-despensa/conservas-sopas-y-precocinados/conservas-de-carne/cat20109/c",
    "https://www.carrefour.es/supermercado/productos-frescos/quesos/rallados/cat690002/c",
    "https://www.carrefour.es/supermercado/productos-frescos/frutas/frutos-del-bosque/cat220009/c",
    "https://www.carrefour.es/supermercado/la-despensa/lacteos/listo-para-beber/cat410003/c",
    "https://www.carrefour.es/supermercado/limpieza-y-hogar/cuidado-de-la-ropa/lejias-lavadora/cat290001/c",
    "https://www.carrefour.es/supermercado/la-despensa/conservas-sopas-y-precocinados/conservas-de-pescado-y-marisco/cat20111/c",
    "https://www.carrefour.es/supermercado/productos-frescos/verduras-y-hortalizas/ensaladas-y-verduras-preparadas/cat220020/c",

  ];
  const productsCarrefourArray = [];
  const page = await browser.newPage();
  const productPage = await browser.newPage();
  for (let i = 0; i < URLs.length; i++) {
    await page.goto(URLs[i]);
    const productsPage = await scrapingCarrefour(page, productPage);
    productsCarrefourArray.push(...productsPage);
  }
  // Hasta aqui el scrapping de Dia, toca meterlo en la bbdd
  await page.close();
  await productPage.close();
  // console.log(productsCarrefourArray);
  await insertproductsCarrefour(productsCarrefourArray, connection);
  await browser.close();
  console.log("CULMINO");
})();
