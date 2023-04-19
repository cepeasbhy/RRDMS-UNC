const isActive = document.querySelectorAll('[data-tab-target]');
const tabContents = document.querySelectorAll('[data-tab-content]');

isActive.forEach(tab => {
    tab.addEventListener("click", () => {
        const target = document.querySelector(tab.dataset.tabTarget);
        tabContents.forEach(content => { content.classList.remove('active') });
        target.classList.add('active');

        isActive.forEach(tab => { tab.classList.remove('active') });
        tab.classList.add('active');
    })
})
