import { Header } from './Header';

let mythemeHeader;

document.addEventListener('DOMContentLoaded', () => {
  const headerDomElement = document.querySelector('.header');
  if (headerDomElement) {
    mythemeHeader = new Header(headerDomElement);
  }
});

export { mythemeHeader };
