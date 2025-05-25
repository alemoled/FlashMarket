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
async function obtenerDescription(container) {
    
}
//*CASO DIA
async function scrapingDia(page) {
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
  const resCategory=await page.evaluate(()=> {
    return document.querySelector(".plp-l1__category-title").textContent
  })
  const results = containers.map((container) => {
    const $ = cheerio.load(container);
    //tittle
    const resTittle = $(".search-product-card__product-name").text().trim();
    //TODO: Descripcion aqui falta porque debes entrar en cada puta pagina de producto y obtener su info, duro como el solo.IDEA:HACEMOS NUEVA PAGINA,HIJA DE ESTAS PARA NO PERDER LA INFO
    //price
    const resPrice = $(".search-product-card__active-price")
      .text()
      .trim()
      .replace(/\u00A0/g, " ");
    //image
    const resImage="https://www.dia.es"+$(".search-product-card__product-image").attr("src")
    return {
      tittle: resTittle,
      price: resPrice,
      image: resImage,
      category:resCategory,
      //store
      store: "Dia"
    };
  });

  return results;
}
//! MAIN DE SCRAPING
(async () => {
  const browser = await puppeteer.launch({
    headless: "new"
  });
  const page = await browser.newPage();
  await page.goto(
    "https://www.dia.es/charcuteria-y-quesos/c/L101?_gl=1*15iam50*_up*MQ..&gclid=CjwKCAjw3MXBBhAzEiwA0vLXQSzUErx4RI3NSCdIAl40PjsqXkKY8gZcJfmDuAkpTGl_B-MQpmgVyhoC7UQQAvD_BwE&gclsrc=aw.ds&gbraid=0AAAAADdKPtLkD2ZoTY5VUSQeWSkerCv-x"
  );
  await page.screenshot({path:"img.png"})
  const scrapedData = await scrapingDia(page);
  console.log(scrapedData);
  await browser.close();
})();
