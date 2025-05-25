import puppeteer from "puppeteer";
import mysql from "mysql2/promise";
// TODO: Json "products", cada unidad estaria almacenado tal que product:{tittle,description,price,image,category,store} */
(async () => {
  const browser = await puppeteer.launch({
    headless: false,
    //slowMo: 200,
  });
  const page = await browser.newPage();
  await page.goto(
    "https://www.dia.es/charcuteria-y-quesos/c/L101?_gl=1*6b39vi*_up*MQ..*_gs*MQ..&gclid=CjwKCAjw3MXBBhAzEiwA0vLXQSzUErx4RI3NSCdIAl40PjsqXkKY8gZcJfmDuAkpTGl_B-MQpmgVyhoC7UQQAvD_BwE&gclsrc=aw.ds&gbraid=0AAAAADdKPtLkD2ZoTY5VUSQeWSkerCv-x"
  );
  await page.waitForNavigation({ waitUntil: "networkidle0" });
  await page.waitForSelector(".basic-section-l1__item-container");
  await page.waitForFunction(
    () =>
      document.querySelectorAll(".basic-section-l1__item-container").length > 0
  );

  const a = await scrapingDia(page);
  console.log(a);
  await browser.close();
})();

async function scrapingDia(page) {
  const data = await page.evaluate(() => {
    const containers = document.querySelectorAll(
      ".basic-section-l1__item-container"
    );
    const results = [...containers].map((container) => {
      const resTittle = container.querySelector(
        ".search-product-card__product-name"
      );

      return {
        tittle: resTittle ? resTittle.textContent.trim() : "No encontrado",
      };
    });
    return results;
  });
  return data;
}
