/**
* Initializes the site's notificationbar module.
* @constructor
* @param {Object} el - The site's notificationbar container element.
*/

import cookies from 'js-cookie'

function notificationbar (el) {
  const closeBtn = el.querySelector('.notification-bar__close-btn')
  const hidePromoBar = cookies.get('hide_promobar')
  const header = document.getElementById('header')
  const pageWrapper = document.querySelector('.main-content')

  let promoBarHeight = el.offsetHeight
  let headerHeight = header.offsetHeight

  if (typeof hidePromoBar === 'undefined') {
    showBar(el, header, promoBarHeight, headerHeight, pageWrapper)
  } else {
    header.removeChild(el)
  }

  closeBtn.addEventListener('click', function () {
    disableBar(el, header, promoBarHeight, headerHeight, pageWrapper)
  })

  window.onresize = () => {
    if (el.offsetHeight !== promoBarHeight || header.offsetHeight !== headerHeight) {
      promoBarHeight = el.offsetHeight
      headerHeight = header.offsetHeight
      showBar(el, header, promoBarHeight, headerHeight, pageWrapper)
    }
  }
}

const disableBar = (promobar, header, promoBarHeight, headerHeight, pageWrapper) => {
  cookies.set('hide_promobar', 'true', { expires: 31 })
  promobar.style.transform = `translateY(-${promoBarHeight}px)`
  header.style.transform = `translateY(0)`
  pageWrapper.style.paddingTop = headerHeight + 'px'
  setTimeout(() => {
    header.removeChild(promobar)
  }, 300)
}

const showBar = (promoBar, header, promoBarHeight, headerHeight, pageWrapper) => {
  if (promoBar.innerHTML.length) {
    header.style.transform = `translateY(${promoBarHeight}px)`
    pageWrapper.style.paddingTop = headerHeight + promoBarHeight + 'px'
  }
}

export default notificationbar
