import init from './lib/init-modules'
import LazyLoad from 'vanilla-lazyload'
import { addClass, supportsObjectFit } from 'lib/util'
import objectFitImages from 'object-fit-images'

document.addEventListener('DOMContentLoaded', () => {
  init({
    module: 'modules'
  }).mount()

  if (!supportsObjectFit()) {
    document.body.classList.add('no-object-fit')
    objectFitImages()
  }

  const loadImg = new LazyLoad({
    elements_selector: '.image-src',
    threshold: 200,
    data_srcset: window.outerWidth > 799 ? 'srcset' : 'srcset-mobile',
    callback_loaded: function (el) {
      const elParent = el.parentElement
      addClass(elParent, 'img-loaded')
    }
  })
})
