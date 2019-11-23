$(document).ready(function() {
  
const $slider = $('#owl-demo')
const SLIDER_TIMEOUT = 3000


$slider.owlCarousel({
  items: 1,
  lazyLoad : true,
  nav: false,
  dots: true,
  autoplay: true,
  autoplayTimeout: SLIDER_TIMEOUT,
  autoplayHoverPause: false,
  loop: true,
  smartSpeed: 20,
  onInitialized: ({target}) => {
    const animationStyle = `-webkit-animation-duration:${SLIDER_TIMEOUT}ms;animation-duration:${SLIDER_TIMEOUT}ms`
    const progressBar = $(
      `<div class="slider-progress-bar"><span class="progress" style="${animationStyle}"></span></div>`
    )
    $(target).append(progressBar)
  },
  onChanged: ({type, target}) => {
    if (type === 'changed') {
      const $progressBar = $(target).find('.slider-progress-bar')
      const clonedProgressBar = $progressBar.clone(true)

      $progressBar.remove()
      $(target).append(clonedProgressBar)
    }
  }
})
});