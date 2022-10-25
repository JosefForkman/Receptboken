let hedder = document.querySelector('header');
let hamburgerOpen = document.querySelector('#hamburgerOpen');
let hamburgerClose = document.querySelector('#hamburgerClose');

hamburgerOpen.addEventListener('click', nav)
hamburgerClose.addEventListener('click', nav)

function nav () {
    hedder.classList.toggle('active');
}
