//----------------------------------------

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

//ccpp guardado
document.addEventListener("DOMContentLoaded", () => {
  const cp = localStorage.getItem("codigoPostal");
  if (cp) {
    const resultado = document.getElementById("resultado");
    if (resultado) {
      resultado.textContent = "Código Postal: " + cp;
    }
  }
});

// Mostrar/ocultar menú de usuario
const userMenuToggle = document.getElementById('userMenuToggle');
const userDropdown = document.getElementById('userDropdown');

userMenuToggle.addEventListener('click', (e) => {
  e.stopPropagation();
  userDropdown.classList.toggle('hidden');
});

// Cierra si haces clic fuera
document.addEventListener('click', (e) => {
  if (!userMenuToggle.contains(e.target)) {
    userDropdown.classList.add('hidden');
  }
});

// Lógica de sesión simulada
const userGreeting = document.getElementById('userGreeting');
const authOnlyElements = document.querySelectorAll('.auth-only');
const loginBtn = document.getElementById('loginBtn');
const logoutBtn = document.getElementById('logoutBtn');
const registerBtn = document.getElementById('registerBtn');

function actualizarMenuUsuario() {
  const usuario = localStorage.getItem('usuario');

  if (usuario) {
    userGreeting.textContent = `Hola, ${usuario}`;
    authOnlyElements.forEach(el => el.classList.remove('hidden'));
    loginBtn.classList.add('hidden');
    registerBtn.classList.add('hidden');
  } else {
    userGreeting.textContent = 'Bienvenido';
    authOnlyElements.forEach(el => el.classList.add('hidden'));
    loginBtn.classList.remove('hidden');
    registerBtn.classList.remove('hidden');
  }
}

// Simula iniciar sesión
loginBtn.addEventListener('click', () => {
  const nombre = prompt('Introduce tu nombre de usuario');
  if (nombre) {
    localStorage.setItem('usuario', nombre);
    actualizarMenuUsuario();
  }
});

// Simula registrarse
registerBtn.addEventListener('click', () => {
  const nombre = prompt('Elige un nombre de usuario');
  if (nombre) {
    localStorage.setItem('usuario', nombre);
    actualizarMenuUsuario();
  }
});

// Cerrar sesión
logoutBtn.addEventListener('click', () => {
  localStorage.removeItem('usuario');
  actualizarMenuUsuario();
});

// Ejecutar al cargar
actualizarMenuUsuario();

//lista
const listsContainer = document.getElementById('lists-container');
    const createListBtn = document.getElementById('create-list-btn');
    const listTitleInput = document.getElementById('list-title');

    let shoppingLists = [];

    function renderLists() {
      listsContainer.innerHTML = '';
      shoppingLists.forEach((list, index) => {
        const listEl = document.createElement('div');
        listEl.className = 'shopping-list';

        listEl.innerHTML = `
          <div style="flex: 1;">
            <h2>${list.title}</h2>
            <ul>
              ${list.items.map((item, i) =>
                `<li>
                  <input type="checkbox" ${item.done ? 'checked' : ''} onchange="toggleItem(${index}, ${i})" />
                  ${item.name}
                  <button onclick="removeItem(${index}, ${i})">🗑️</button>
                </li>`).join('')}
            </ul>
            <input type="text" placeholder="Añadir producto..." onkeypress="if(event.key === 'Enter') addItem(${index}, this)" />
          </div>
          <div style="display: flex; align-items: center;">
            <button onclick="deleteList(${index})">Eliminar lista</button>
          </div>
        `;
        listsContainer.appendChild(listEl);
      });
    }

    createListBtn.addEventListener('click', () => {
      const title = listTitleInput.value.trim();
      if (title) {
        shoppingLists.push({ title, items: [] });
        listTitleInput.value = '';
        renderLists();
      }
    });

    function addItem(listIndex, input) {
      const name = input.value.trim();
      if (name) {
        shoppingLists[listIndex].items.push({ name, done: false });
        input.value = '';
        renderLists();
      }
    }

    window.removeItem = function(listIndex, itemIndex) {
      shoppingLists[listIndex].items.splice(itemIndex, 1);
      renderLists();
    };

    window.toggleItem = function(listIndex, itemIndex) {
      shoppingLists[listIndex].items[itemIndex].done = !shoppingLists[listIndex].items[itemIndex].done;
      renderLists();
    };

    window.deleteList = function(index) {
      if (confirm('¿Seguro que quieres eliminar esta lista?')) {
        shoppingLists.splice(index, 1);
        renderLists();
      }
    };

    




