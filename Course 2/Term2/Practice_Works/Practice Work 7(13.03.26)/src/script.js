var assortmentData = [
  {
    inStock: true,
    isHit: true
  },
  {
    inStock: false,
    isHit: false
  },
  {
    inStock: true,
    isHit: true
  },
  {
    inStock: true,
    isHit: false
  },
  {
    inStock: false,
    isHit: false
  }
];

function updateCards(data) {
  var cards = document.querySelectorAll('.good');
  var len = Math.min(data.length, cards.length);
  for (var i = 0; i < len; i++) {
    var card = cards[i];
    card.classList.remove('good--available', 'good--unavailable', 'good--hit');
    if (data[i].inStock) {
      card.classList.add('good--available');
    } else {
      card.classList.add('good--unavailable');
    }
    if (data[i].isHit) {
      card.classList.add('good--hit');
    }
  }
}updateCards(assortmentData);