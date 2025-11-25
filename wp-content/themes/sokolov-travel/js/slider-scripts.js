new Swiper('.hero-slider', {
  slidesPerView: 1,
  spaceBetween: 20,
  // loop: true,
  pagination: {
    el: '.slider-pagination',
    clickable: true,
  },
  speed: 1200,
  loop: true,
  autoplay: {
    delay: 7500,
    disableOnInteraction: false,
  },
  effect: 'slide',
});

new Swiper('.posts-swiper', {
  slidesPerView: 1.3,
  spaceBetween: 20,
  // loop: true,
  // pagination: {
  //   el: '.slider-pagination',
  //   clickable: true,
  // },
  breakpoints: {
    1200: {
      slidesPerView: 3,
      spaceBetween: 40,
    },

    1024: {
      slidesPerView: 2.4,
    }
  }
});
