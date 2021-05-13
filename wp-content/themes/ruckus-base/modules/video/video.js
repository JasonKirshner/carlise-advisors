import Plyr from 'plyr/dist/plyr.polyfilled'
import {
  addClass,
  hasParent,
  contains,
  removeClass
} from 'lib/util'

export default (el) => {
  const video = el.querySelector('.js-video') || false
  const isHero = hasParent(el, 'hero-asset')
  let plyr
  let playFlag = true
  const hero = document.querySelector('.hero')
  const heroAsset = document.querySelector('.hero-asset')
  const heroClose = document.querySelector('.hero-asset-svg')

  const breakpointLGMax = window.matchMedia('(max-width: 991px)')

  const plyrParams = {
    autoplay: false,
    resetOnEnd: true,
    controls: ['play-large', 'play', 'progress', 'volume', 'captions', 'mute']
  }

  const heroCloseListener = () => {
    removeClass(hero, 'hero--modal')
    console.log('here')
    plyr.pause()
  }

  const elListener = () => {
    addClass(hero, 'hero--modal')
  }

  const docListener = e => {
    if (!hasParent(e.target, 'hero-asset') && e.target !== heroAsset && contains(hero, 'hero--modal')) {
      removeClass(hero, 'hero--modal')
      plyr.pause()
    }
  }

  const videoModalDisable = () => {
    if (video) {
      const src = window.innerWidth > 799 ? video.getAttribute('data-src') : video.getAttribute('data-src-mobile')

      video.setAttribute('src', src)
      addClass(el, 'is-loaded')

      if (el.classList.contains('player')) {
        if (breakpointLGMax.matches) {
          const plyrParamsFullscreen = { ...plyrParams, controls: [...plyrParams.controls, 'fullscreen'] }
          plyr = new Plyr(video, plyrParamsFullscreen)

          document.removeEventListener('click', docListener)
          el.removeEventListener('click', elListener)
          heroClose.removeEventListener('click', heroCloseListener)
        } else {
          plyr = new Plyr(video, plyrParams)
        }
      }
    }
  }

  // Listeners for hero module only
  if (isHero) {
    document.addEventListener('click', docListener)
    heroClose.addEventListener('click', heroCloseListener)
    el.addEventListener('click', elListener)
    breakpointLGMax.addListener(videoModalDisable)
  }

  videoModalDisable()

  if (isHero) {
    plyr.on('enterfullscreen exitfullscreen', () => {
      playFlag = true
    })
  }

  video.addEventListener('play', () => {
    addClass(hero, 'hero--show-controls')

    if (playFlag) {
      plyr.restart()
      playFlag = false
    }
  })
}
