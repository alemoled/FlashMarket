// TODO: Json "products", cada unidad estaria almacenado tal que product:{tittle,description,price,image,category,store} */
import puppeteer from "puppeteer-extra";
import StealthPlugin from "puppeteer-extra-plugin-stealth";
import * as cheerio from "cheerio";
import mysql from "mysql2/promise";
//Para que el bot no sea automaticamente bloqueado y podamos trabajar sin abrir un navegador
puppeteer.use(StealthPlugin());
async function autoScroll(page) {
  await page.evaluate(async () => {
    await new Promise((resolve) => {
      let totalHeight = 0;
      const distance = 500; // Distancia que se mueve en cada scroll
      const timer = setInterval(() => {
        const scrollHeight = document.body.scrollHeight;
        window.scrollBy(0, distance);
        totalHeight += distance;

        if (totalHeight >= scrollHeight) {
          clearInterval(timer);
          resolve();
        }
      }, 50); // Intervalo de tiempo entre cada scroll
    });
  });
}
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
      return (
        document.querySelector(".text-section__text")?.textContent.trim() ||
        document.querySelector(".breadcrumb__product-name").textContent.trim()
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
async function scrapingDia(page, browser) {
  await autoScroll(page);
  // Con lo siguiente Sacamos todas las etiquetas que son la unidad de producto en dia,luego lo manipulamos segun guste
  const containers = await page.evaluate(() => {
    return Array.from(
      document.querySelectorAll(".basic-section-l1__item-container")
    ).map((container) => {
      return container.outerHTML;
    });
  });
  //category
  const resCategory = await page.evaluate(() => {
    return document.querySelector(".plp-l1__category-title").textContent;
  });
  const results = await Promise.all(
    containers.map(async (container) => {
      const $ = cheerio.load(container);
      //tittle
      const resTittle = $(".search-product-card__product-name").text().trim();
      //TODO: Descripcion aqui falta porque debes entrar en cada puta pagina de producto y obtener su info, duro como el solo.IDEA:HACEMOS NUEVA PAGINA,HIJA DE ESTAS PARA NO PERDER LA INFO
      const productURL =
        "https://www.dia.es" +
        $(".search-product-card__product-link").attr("href");
      const resDescription = await getDescription(productURL, browser);
      //price
      const resPrice = $(".search-product-card__active-price")
        .text()
        .trim()
        .replace(/\u00A0/g, " ");
      //image
      const resImage =
        "https://www.dia.es" +
        $(".search-product-card__product-image").attr("src");
      return {
        tittle: resTittle,
        description: resDescription,
        price: resPrice,
        image: resImage,
        category: resCategory,
        //store
        store: "Dia",
      };
    })
  );

  return results;
}
//! MAIN DE SCRAPING
(async () => {
  const browser = await puppeteer.launch({
    headless: "new",
  });
  const page = await browser.newPage();
  await page.goto(
    "https://www.dia.es/leche-huevos-y-mantequilla/c/L108?_gl=1*bmlkzm*_up*MQ..&gclid=CjwKCAjw3MXBBhAzEiwA0vLXQSzUErx4RI3NSCdIAl40PjsqXkKY8gZcJfmDuAkpTGl_B-MQpmgVyhoC7UQQAvD_BwE&gclsrc=aw.ds&gbraid=0AAAAADdKPtLkD2ZoTY5VUSQeWSkerCv-x"
  );
  await page.screenshot({ path: "img.png" });
  const scrapedData = await scrapingDia(page, browser);
  console.log(scrapedData);
  await browser.close();
})();
