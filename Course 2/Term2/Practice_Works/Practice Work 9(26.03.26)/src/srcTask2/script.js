let pictures = [
  'img/tomato-red-large.jpg',
  'img/tomato-yellow-large.jpg',
  'img/tomato-strange-large.jpg'
];



/* Техническое задание

Мяу! Нужно оживить галерею с фотографиями товаров.

В галерее есть миниатюры (элементы с классом 'gallery__picture-preview') и большое изображение (класс 'full-picture').

После клика по превью большая фотография должна поменяться. Большое изображение должно быть таким же, как и в миниатюре, только большего размера.

Пути к полноразмерным фотографиям находятся в массиве pictures. Порядок элементов в массиве такой же, как и порядок миниатюр в разметке.

*/

const previews = document.querySelectorAll('.gallery__picture-preview');
const fullPicture = document.querySelector('.full-picture');
for (let i = 0; i < previews.length; i++) {
  previews[i].addEventListener('click', function () {
    fullPicture.src = pictures[i];
  });
}