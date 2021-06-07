/**
 * Initializes the javascript for the navigation module
 * @param {Object} el - The DOM Node containing the data-module="navigation" attribute.
 */
import scrollToElement from 'scroll-to-element'

const navigation = (el) => {
  const navLink = el.querySelectorAll('links')
  navLink.forEach(element => {
    element.addEventListener('click', () => {
      const link = document.getElementById(element.getAttribute('data-link'))
      scrollToElement(link, 'smooth')
    })
  })
  console.warn('initializing navigation module')
}

export default navigation
