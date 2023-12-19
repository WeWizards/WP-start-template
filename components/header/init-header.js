import { Header } from './Header';

let biHeader;

document.addEventListener('DOMContentLoaded', () => {
  const headerDomElement = document.querySelector('.header');
  if (headerDomElement) {
    biHeader = new Header(headerDomElement);
  }
});

export { biHeader };
