document.addEventListener('DOMContentLoaded', () => {
    const newsItems = document.querySelectorAll('.news-item');
    
    newsItems.forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('expanded');
        });
    });
});
