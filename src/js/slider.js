//  Global variables
const sliderView = document.querySelector('.guisopo-slider--view > ul'),
      sliderViewSlides = document.querySelectorAll('.guisopo-slider--view__slides'),
      arrowLeft = document.querySelector('.guisopo-slider--arrows__left'),
      arrowRight = document.querySelector('.guisopo-slider--arrows__right'),
      sliderLenght = sliderViewSlides.length;

//  Sliding Function
const slideMe = (sliderViewItems, isActiveItem) => {
  //  update classes
  isActiveItem.classList.remove('is-active');
  sliderViewItems.classList.add('is-active');
  //  css transform the active slide position
  sliderView.setAttribute('style', `transform:translateX(-${sliderViewItems.offsetLeft}px)`);
}

//  Before Sliding Function
const beforeSliding = i => {
  let isActiveItem = document.querySelector('.guisopo-slider--view__slides.is-active'),
      currentItem = Array.from(sliderViewSlides).indexOf(isActiveItem) + i,
      nextItem = currentItem + i,
      sliderViewItems = document.querySelector(`.guisopo-slider--view__slides:nth-child(${nextItem})`);
  
  //  if nextItem > # of slides
  if(nextItem > sliderLenght) {
    sliderViewItems = document.querySelector('.guisopo-slider--view__slides:nth-child(1)');
  }
  //  if nextItem = 0
  if(nextItem == 0) {
    sliderViewItems = document.querySelector(`.guisopo-slider--view__slides:nth-child(${sliderLenght})`);
  }
  
  //  trigger sliding method
  slideMe(sliderViewItems, isActiveItem);
}

//  Trigger Arrows
arrowRight.addEventListener('click', () => beforeSliding(1));
arrowLeft.addEventListener('click', () => beforeSliding(0));