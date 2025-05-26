document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.getElementById('carousel');
  const cardWidth = 18 * 16 + 16; // 18rem * 16px + 16px gap

  document.getElementById('next').addEventListener('click', () => {
    carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
  });

  document.getElementById('prev').addEventListener('click', () => {
    carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
  });
});
