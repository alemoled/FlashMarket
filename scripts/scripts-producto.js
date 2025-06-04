//divisas
const currencyBtn = document.getElementById('currency-btn');
const currencyLabel = document.getElementById('currency-label');
const productPrices = document.querySelectorAll('.product-price');
const products = document.querySelectorAll('.product');

const currencies = {
  EUR: { symbol: '€', rate: 1 },
  USD: { symbol: '$', rate: 1.1 },
  GBP: { symbol: '£', rate: 0.85 }
};

let currentCurrency = 'EUR';

currencyBtn.addEventListener('click', () => {
  // Cambiar al siguiente currency
  const keys = Object.keys(currencies);
  let index = keys.indexOf(currentCurrency);
  currentCurrency = keys[(index + 1) % keys.length];

  updatePrices();
});

function updatePrices() {
  currencyLabel.textContent = currentCurrency;
  
  products.forEach(product => {
    const basePrice = parseFloat(product.getAttribute('data-price'));
    const convertedPrice = basePrice * currencies[currentCurrency].rate;
    const priceElement = product.querySelector('.product-price');
    priceElement.textContent = `${currencies[currentCurrency].symbol}${convertedPrice.toFixed(2)}`;
  });
}

// Inicializar precios
updatePrices();

//----------------------------------------

// Menú desplegable de categorías extra
const menuBtn = document.querySelector('.menu-btn');
const categoryDropdown = document.getElementById('category-dropdown');

menuBtn.addEventListener('click', () => {
  categoryDropdown.classList.toggle('hidden');
});

// Cierra el menú si haces clic fuera de él
document.addEventListener('click', (e) => {
  if (!menuBtn.contains(e.target) && !categoryDropdown.contains(e.target)) {
    categoryDropdown.classList.add('hidden');
  }
});
