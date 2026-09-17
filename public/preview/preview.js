const menuButton = document.querySelector('.menu-button');
const navigation = document.querySelector('#navigation');
const lightbox = document.querySelector('.lightbox');

menuButton.addEventListener('click', () => {
  const open = navigation.classList.toggle('open');
  menuButton.setAttribute('aria-expanded', String(open));
});

navigation.addEventListener('click', () => {
  navigation.classList.remove('open');
  menuButton.setAttribute('aria-expanded', 'false');
});

document.querySelectorAll('.fleet-grid button').forEach((button) => {
  button.addEventListener('click', () => {
    lightbox.querySelector('img').src = button.dataset.image;
    lightbox.querySelector('img').alt = button.dataset.caption;
    lightbox.querySelector('p').textContent = button.dataset.caption;
    lightbox.showModal();
  });
});

lightbox.querySelector('button').addEventListener('click', () => lightbox.close());
lightbox.addEventListener('click', (event) => { if (event.target === lightbox) lightbox.close(); });

document.querySelector('.contact-form').addEventListener('submit', (event) => {
  event.preventDefault();
  if (!event.currentTarget.reportValidity()) return;
  event.currentTarget.querySelector('.form-status').textContent = 'Thank you for contacting Mare Ventus Logistics. Our team will get back to you shortly.';
  event.currentTarget.reset();
});
