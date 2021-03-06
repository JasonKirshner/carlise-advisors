export const isMobile = () =>
  typeof window.orientation !== 'undefined' ||
  navigator.userAgent.indexOf('IEMobile') !== -1

export const supportsObjectFit = () => {
  let objectFit = false
  for (const prop in document.documentElement.style) {
    if (/object(?:-f|F)it$/.test(prop)) {
      objectFit = true
      break
    }
  }
  return objectFit
}

export const isIE = () => {
  return navigator.userAgent.toLowerCase().indexOf('msie') > 0
}

export const isIEorEdge = () => {
  if (document.documentMode || /Edge/.test(navigator.userAgent)) {
    return true
  } else {
    return false
  }
}

export const isFirefox = () => {
  return navigator.userAgent.toLowerCase().indexOf('firefox') > -1
}

export const write = (el, value) => {
  el.innerHTML = value
}

export const addClass = (item, selector) => {
  if (item instanceof NodeList) {
    for (const i of item) {
      i.classList.add(selector)
    }
  } else {
    item.classList.add(selector)
  }
}

export const removeClass = (item, selector) => {
  if (item instanceof NodeList) {
    for (const i of item) {
      i.classList.remove(selector)
    }
  } else {
    item.classList.remove(selector)
  }
}

export const contains = (item, selector) => {
  return item.classList.contains(selector)
}

export const toggle = (item, selector) => {
  if (item instanceof NodeList) {
    for (const i of item) {
      i.classList.toggle(selector)
    }
  } else {
    item.classList.toggle(selector)
  }
}

export const getHeight = el => {
  return `${el.offsetHeight}px`
}

export const getWidth = el => {
  return `${el.offsetWidth}px`
}

export const isOver = breakpoint => {
  return window.innerWidth > breakpoint
}

export const deepClone = obj => {
  return JSON.parse(JSON.stringify(obj))
}

export const formatPrice = (num, fraction = 2) => {
  return (Number(num) / 100).toLocaleString('en-EN', {
    minimumFractionDigits: fraction
  })
}

export const getUrlParam = name => {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]') // eslint-disable-line
  const regex = new RegExp('[\\?&]' + name + '=([^&#]*)')
  const results = regex.exec(location.search)
  return results === null
    ? ''
    : decodeURIComponent(results[1].replace(/\+/g, ' '))
}

export const handleize = str => str.replace(/[ /_]/g, '-').toLowerCase()

/**
 * Decodes a string that has been encode through the 'url_encode' Shopify filter
 * @param {*} str
 */
export const decode = str => decodeURIComponent(str).replace(/\+/g, ' ')

/**
 * Generates a URL that is suitable for the Shopify
 * image CDN. Adds the current image size suffix.
 *
 * @param {*} src
 * @param {*} size
 */
export const getImageWithSize = (src = '', size = 1000) => {
  return ('' + src).replace(/([.](?:jpe?g|png))/, `_${size}x$1`)
}

/**
 * Used by components like the product card to select
 * the current product image based on the active color.
 * If there is no active color, a fallback image
 * should be returned if it is defined.
 *
 * @param {*} color
 * @param {*} images
 * @param {*} featured
 * @param {*} fallback
 */
export const getProductImage = (
  images,
  featured = false,
  fallback = false,
  name = '',
  value = ''
) => {
  const key = `${name}-${(value || '').replace(/[/ ]/g, '-')}`.toLowerCase()
  const image = (images || []).find(i => {
    return ~i.indexOf(key) && ~i.indexOf(featured ? 'pos-1' : 'pos-2')
  })
  if (!image) {
    return getImageWithSize(fallback, 600)
  }
  return getImageWithSize(image, featured ? 1200 : 600)
}

export const createArrayFromNumRange = (size, start) => {
  return Array.from(Array(size), (_, i) => start + i)
}

export const createMonthArray = () => {
  return [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ]
}

/**
 * Throttle a function so that it fires once every { threshold }
 * @param {Function} fn
 * @param {Integer} threshold
 * @param {FunctionContext} scope
 */

export const throttle = (fn, threshold, scope) => {
  if (!threshold) {
    threshold = 250
  }

  let last, deferTimer

  return function () {
    const context = scope || this
    const now = +new Date()
    const args = arguments

    if (last && now < last + threshold) {
      // hold on to it
      clearTimeout(deferTimer)
      deferTimer = setTimeout(function () {
        last = now
        fn.apply(context, args)
      }, threshold)
    } else {
      last = now
      fn.apply(context, args)
    }
  }
}

/* Element.closest() polyfill for IE11 */
if (!Element.prototype.matches) {
  Element.prototype.matches =
    Element.prototype.msMatchesSelector ||
    Element.prototype.webkitMatchesSelector
}

if (!Element.prototype.closest) {
  Element.prototype.closest = function (s) {
    let el = this

    do {
      if (el.matches(s)) return el
      el = el.parentElement || el.parentNode
    } while (el !== null && el.nodeType === 1)
    return null
  }
}

/**
 * Debounce a function, generally used for a scroll event
 * @param {Function} fn
 */

export const debounce = fn => {
  // This holds the requestAnimationFrame reference, so we can cancel it if we wish
  let frame
  // The debounce function returns a new function that can receive a variable number of arguments
  return (...params) => {
    // If the frame variable has been defined, clear it now, and queue for next frame
    if (frame) {
      cancelAnimationFrame(frame)
    }
    // Queue our function call for the next frame
    frame = requestAnimationFrame(() => {
      // Call our function and pass any params we received
      fn(...params)
    })
  }
}

export const hasParent = (element, className) => {
  if (!element.parentNode) {
    return false
  }

  if (contains(element, className)) {
    return element
  }

  return hasParent(element.parentNode, className)
}
