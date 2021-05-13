/**
 * Initializes the site's form module.
 * @constructor
 * @param {Object} el - The site's form container element.
 */
import scrollTo from 'scroll-to-element'

function form (el) {
  const valMessage = el.querySelectorAll('form')
  const navigation = document.querySelector('.navigation')
  const notificationBar = document.querySelector('.notification-bar')
  const offset = notificationBar ? -(navigation.offsetHeight + notificationBar.offsetHeight) : -navigation.offsetHeight

  if (valMessage[0].querySelectorAll('.validation_message').length) {
    scrollTo(valMessage[0], {
      offset: offset,
      ease: 'inOutCirc'
    })
  }
}

export default form
