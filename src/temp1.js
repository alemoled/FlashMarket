import puppeteer from "puppeteer";
import mysql from "mysql2/promise";
// TODO: Json "products", cada unidad estaria almacenado tal que product:{tittle,description,price,image,category,store} */
// 🔴 // ! Importante → Texto en rojo
// 🟡 // TODO → Texto en amarillo

/* Creamos funcion asincrona anonima la cual se ejecutara 
inmediatamente,basicamente nuesto main de java */
(async () => {
  /* Creamos una instacia de objeto navegador,como java */
  const browser = await puppeteer.launch({
    headless: false,
    slowMo: 200,
  });
  /* Que es un navegador sin una pagina */
  const page = await browser.newPage();

  // ! CASO CARREFOUR:
  //**    PAGINA PRODUCTOS FRESCOS
  await page.goto(
    "https://www.carrefour.es/supermercado/productos-frescos/cat20002/c"
  );
  /* Ahora lo que haremos ya que es una funcion GENERAL
  de como realizar el scrping en Carrefour ya que sus paginas son similares*/
  async function scrapingCarrefour(page) {
    //!OJO: este page introducido como parametro aun no es nuestro objeto, es uno general**
    //TODO:Como parece que la primera vez que entras sale el aceptar cookie,debemos saltar este obstaculo para trabajar bien con la pagina
    const firstTime = await page.evaluate(() => getComputedStyle(document.body).overflow === "hidden");

    const results = await page.evaluate(() => {
    return Array.from(document.querySelectorAll(".product-card-list__item")).map(product => ({
        titulo: product.querySelector(".product-card__title-link.track-click")?.innerText.trim() || "Sin título"
    }));
});
    
    return results
  }

  console.log(scrapingCarrefour(page))
  /* Y aqui comienza el escrapeo' */
})();
