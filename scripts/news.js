document.addEventListener('DOMContentLoaded', function() {
    const newsContainer = document.querySelector('.news-container');

    let isDown = false;
    let startX;
    let scrollLeft;

    newsContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        newsContainer.classList.add('active');
        startX = e.pageX - newsContainer.offsetLeft;
        scrollLeft = newsContainer.scrollLeft;
    });

    newsContainer.addEventListener('mouseleave', () => {
        isDown = false;
        newsContainer.classList.remove('active');
    });

    newsContainer.addEventListener('mouseup', () => {
        isDown = false;
        newsContainer.classList.remove('active');
    });

    newsContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - newsContainer.offsetLeft;
        const walk = (x - startX) * 3; //scroll-fast
        newsContainer.scrollLeft = scrollLeft - walk;
    });

    // For touch devices
    newsContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].pageX - newsContainer.offsetLeft;
        scrollLeft = newsContainer.scrollLeft;
    });

    newsContainer.addEventListener('touchmove', (e) => {
        const x = e.touches[0].pageX - newsContainer.offsetLeft;
        const walk = (x - startX) * 3; //scroll-fast
        newsContainer.scrollLeft = scrollLeft - walk;
    });
});
