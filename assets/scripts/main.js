//Move the arrow up on mouseover:
const arrowUp = document.querySelector('.to-top')
const arrow = document.querySelector('.arrow')
const newArrow = document.querySelector('.to-top img')


arrowUp.addEventListener('mouseover', () => {
  arrow.classList.add('move');
  newArrow.setAttribute("src", "img/pil-upp-bla.svg")
});

arrowUp.addEventListener('mouseout', () => {
  newArrow.setAttribute("src", "img/pil-upp.svg");
});
