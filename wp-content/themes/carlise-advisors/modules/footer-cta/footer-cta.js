/**
 * Initializes the javascript for the footer-cta module
 * @param {Object} el - The DOM Node containing the data-module="footer-cta" attribute.
 */
import scrollToElement from 'scroll-to-element'

const footerCta = (el) => {
  const button = el.querySelector('.footer-cta-button')
  button.addEventListener('click', () => {
    scrollToElement('.hero')
  })
}

export default footerCta
