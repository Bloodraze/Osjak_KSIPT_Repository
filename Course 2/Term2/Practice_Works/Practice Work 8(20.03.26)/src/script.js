var cardsData = [
  {
    inStock: true,
    imgUrl: 'img/choco.jpg',
    text: 'Сливочно-кофейное с кусочками шоколада',
    price: 310,
    isHit: true,
    specialOffer: 'Двойная порция сиропа бесплатно!'
  },
  {
    inStock: false,
    imgUrl: 'img/lemon.jpg',
    text: 'Сливочно-лимонное с карамельной присыпкой',
    price: 125,
    isHit: false
  },
  {
    inStock: true,
    imgUrl: 'img/cowberry.jpg',
    text: 'Сливочное с брусничным джемом',
    price: 170,
    isHit: false
  },
  {
    inStock: true,
    imgUrl: 'img/cookie.jpg',
    text: 'Сливочное с кусочками печенья',
    price: 250,
    isHit: false
  },
  {
    inStock: true,
    imgUrl: 'img/creme-brulee.jpg',
    text: 'Сливочное крем-брюле',
    price: 190,
    isHit: false
  }
];




/* Техническое задание

Мяу! Помнишь магазин мороженого? Нужно создать карточки товаров, основываясь на данных, полученных с сервера.

Данные — массив объектов cardsData, один элемент соответствует одному товару. У каждого объекта есть следующие свойства:

- inStock — доступность товара. Если значение true — товар доступен (для такого продукта верстальщик подготовил класс good--available), если false — продукта нет в наличии (товар с классом good--unavailable).
- imgUrl — ссылка на изображение товара.
- text — название продукта.
- price — цена.
- isHit — является ли товар хитом продаж. Если значение true — продукт «хитовый». Для такого товара подготовлен класс good--hit.
- specialOffer — специальное предложение, которое есть только у хита продаж. Должно находиться в абзаце с классом good__special-offer и быть самым последним дочерним элементом в карточке.

Вот пример вёрстки одной карточки в каталоге:

<ul class="goods">
  <li class="good">
    <h2 class="good__description">Сливочно-кофейное с кусочками шоколада</h2>
    <img class="good__image" src="gllacy/choco.jpg" alt="Сливочно-кофейное с кусочками шоколада">
    <p class="good__price">110₽/кг</p>
  </li>
  ...
</ul>

Обрати внимание, что текст в атрибуте alt у изображения должен быть таким же, как и название товара.

Создай функцию renderCards, которая будет принимать на вход массив данных, вызови её, передав cardsData, и отрисуй на странице карточки мороженого.

*/


function makeElement(tagName, className, text) {
  const element = document.createElement(tagName);
  if (className) {
    element.classList.add(className);
  }
  if (text) {
    element.textContent = text;
  }
  return element;
}
function createCard(good) {
  const listItem = makeElement('li', 'good');
  let availabilityClass = 'good--available';
  if (!good.inStock) {
    availabilityClass = 'good--unavailable';
  }
  listItem.classList.add(availabilityClass);
  const title = makeElement('h2', 'good__description', good.text);
  listItem.appendChild(title);
  const picture = makeElement('img', 'good__image');
  picture.src = good.imgUrl;
  picture.alt = good.text;
  listItem.appendChild(picture);
  const price = makeElement('p', 'good__price', good.price + '₽/кг');
  listItem.appendChild(price);
  if (good.isHit) {
    listItem.classList.add('good--hit');
    const specialOffer = makeElement('p', 'good__special-offer', good.specialOffer);
    listItem.appendChild(specialOffer);
  }
  return listItem;
}
function renderCards(goods) {
  const cardList = document.querySelector('.goods');

  for (let i = 0; i < goods.length; i++) {
    const cardItem = createCard(goods[i]);
    cardList.appendChild(cardItem);
  }
}
renderCards(cardsData);