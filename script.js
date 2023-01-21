let burgerModal = document.getElementById('hamburgerModal')
let burgerMenu = document.getElementById('burgerMenu')
let closeModal = document.getElementById('closeModal')
burgerMenu.addEventListener('click', function(){
  burgerModal.style = 'display: flex'
})

closeModal.addEventListener('click', function(){
  burgerModal.style = 'display: none'
})

console.log(1);


