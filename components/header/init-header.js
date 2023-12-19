import { Header } from './Header';

let wwzrdsHeader;

document.addEventListener('DOMContentLoaded', () => {
  const headerDomElement = document.querySelector('.header');
  if (headerDomElement) {
    wwzrdsHeader = new Header(headerDomElement);
  }
});

export { wwzrdsHeader };
