/**
 * Initializes the javascript for the navigation module
 * @param {Object} el - The DOM Node containing the data-module="navigation" attribute.
 */
import scrollToElement from 'scroll-to-element'

const navigation = (el) => {
  const navLink = el.querySelectorAll('.link')
  const container = el.querySelector('.navigation__container')

  Array.from(navLink).forEach(element => {
    element.addEventListener('click', function () {
      scrollToElement(this.value, { offset: -container.offsetHeight })
    })
  })
  const headerimage = el.querySelectorAll('.header_logo')
  headerimage[0].addEventListener('click', function () { scrollToElement('.hero', { offset: -container.offsetHeight }) })
  console.warn('initializing navigation module')
}

export default navigation
