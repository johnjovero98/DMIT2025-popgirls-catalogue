const navMenu = document.querySelector("#menu-button")

navMenu.addEventListener('click', function(){
    const mobileMenu = document.querySelector('#mobile-nav')
    mobileMenu.classList.toggle('hidden')
})


const filterButton = document.querySelector('#filter-button')

filterButton.addEventListener('click', function(){
    const filters = document.querySelector('#filters')
    filters.classList.toggle('hidden')
    filterButton.classList.toggle('rotate-180')
})