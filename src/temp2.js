import puppeteer from "puppeteer";
import mysql from "mysql2/promise";

(async () => {
  const browser = await puppeteer.launch({ headless: false, slowMo:200 });
  const page = await browser.newPage();
  await page.goto(
    "https://www.carrefour.es/supermercado/productos-frescos/cat20002/c"
  );
  async function scrollToBottom(page) {
    let previousHeight = 0;
    let newHeight = 0;
    do {
      previousHeight = newHeight;
      await page.evaluate(() => window.scrollBy(0, window.innerHeight));
      await new Promise((resolve) => setTimeout(resolve, 1000));
      newHeight = await page.evaluate(() => document.body.scrollHeight);
    } while (newHeight > previousHeight);
  }

  async function scrapingCarrefour(page) {
    const firstTime = await page.evaluate(
      () => getComputedStyle(document.body).overflow === "hidden"
    );
    //*CASO PRIMERA VEZ EN LA PAGINA Y ESTE LOS BENDITOS POP-UPS */
    if (firstTime) {
      await page.$eval("#onetrust-accept-btn-handler", (btn) => btn.click()); // ✅ Ahora funciona
      await page.$eval(".icon-cross-thin", (btn) => btn.click()); // ✅ Si es una clase, usar `.`
    }

    await page.waitForSelector(".product-card-list__item");
    await scrollToBottom(page);

    const results = await page.evaluate(() => {
      return Array.from(document.querySelectorAll(".product-card-list__item"))
        .map((product) => {
          const hasLazyCard =
            product.querySelector(".product-card-list__lazy-card") !== null;
          return {
            title: product
              .querySelector(".product-card__title-link.track-click")
              ?.innerText.trim(),
            price: hasLazyCard
              ? product
                  .closest(".product-card__parent")
                  ?.getAttribute("app_price") || "Price not available"
              : product
                  .querySelector(".product-card__price")
                  ?.innerText.trim() || "Price not available",
            image:
              product
                .querySelector(".product-card__image")
                ?.getAttribute("data-src") ||
              product.querySelector(".product-card__image")?.src,
            link: product.querySelector(".product-card__media-link.track-click")
              ?.href,
          };
        })
        .filter((product) => product.title && product.price);
    });
    return results;
  }
  const productosFrescos = await scrapingCarrefour(page);
  console.log(productosFrescos)
  await browser.close();
})();
