(() => {
  'use strict';
  const cards = document.querySelectorAll('.service-card');
  cards.forEach((card) => {
    card.addEventListener('mouseenter', () => card.classList.add('service-card--active'));
    card.addEventListener('mouseleave', () => card.classList.remove('service-card--active'));
  });
})();
