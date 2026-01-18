document.addEventListener('DOMContentLoaded', () => {
    const faqQuestions = document.querySelectorAll('.c-faq-item__question');

    faqQuestions.forEach(button => {
        button.addEventListener('click', () => {
            const currentItem = button.closest('.c-faq-item');
            const activeItems = document.querySelectorAll('.c-faq-item.is-open');
            activeItems.forEach(item => {
                if (item !== currentItem) {
                    item.classList.remove('is-open');
                }
            });

            currentItem.classList.toggle('is-open');
            const isExpanded = currentItem.classList.contains('is-open');
            button.setAttribute('aria-expanded', isExpanded);
        });
    });
});