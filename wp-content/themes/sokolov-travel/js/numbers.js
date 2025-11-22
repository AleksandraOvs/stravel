function animateNumbers(elements, duration = 3500) {
    elements.forEach(el => {
        const target = parseInt(el.dataset.target || el.textContent, 10);
        let start = 0; // начинаем с нуля
        el.textContent = '0'; // сразу показываем 0

        const stepTime = Math.max(Math.floor(duration / target), 20);
        const increment = Math.ceil(target / (duration / stepTime));

        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                start = target;
                clearInterval(timer);
            }
            el.textContent = start;
        }, stepTime);
    });
}

function initNumbers() {
    // проверяем: главная ли страница
    if (window.location.pathname !== '/' && window.location.pathname !== '') {
        return;
    }

    const numbersBlock = document.querySelector('#numbers');
    if (!numbersBlock) return;

    let isAnim = false;

    function scrollTracking() {
        const wh = window.innerHeight;
        const wt = window.scrollY;
        const el = document.querySelector('.about-num__value');
        if (!el) return;

        const rect = el.getBoundingClientRect();
        const et = rect.top + window.scrollY + 50;
        const eh = rect.height;
        const dh = document.documentElement.scrollHeight;

        if (wt + wh >= et || wh + wt === dh || eh + et < wh) {
            isAnim = true;
            const animEls = document.querySelectorAll('.js-anim-numbers');
            animEls.forEach(e => e.classList.add('_show'));
            setTimeout(() => animateNumbers(animEls, 3500), 800);
        }
    }

    window.addEventListener('scroll', () => {
        if (!isAnim) scrollTracking();
    });

    scrollTracking();
}

window.addEventListener('DOMContentLoaded', initNumbers);