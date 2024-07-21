document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('nav');

    menuToggle.addEventListener('click', function() {
        if (nav.style.height === '0px' || nav.style.height === '') {
            nav.style.height = nav.scrollHeight + 'px';
        } else {
            nav.style.height = '0px';
        }
    });
});