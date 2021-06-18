/**
 * Initializes the javascript for the navigation module
 * @param {Object} el - The DOM Node containing the data-module="navigation" attribute.
 */
import scrollToElement from 'scroll-to-element'

const navigation = (el) => {
  const navLink = el.querySelectorAll('.link')
  console.log(navLink)
  Array.from(navLink).forEach(element => {
    element.addEventListener('click', function () {
      scrollToElement(this.value, { offset: -el.offsetHeight })
      console.log(this.value)
    }
    )
  })
  const headerimage = el.querySelectorAll('.header_logo')
  headerimage[0].addEventListener('click', function () { scrollToElement('.hero-container', { offset: -el.offsetHeight }) })
  console.warn('initializing navigation module')
}

export default navigation
