document.addEventListener("DOMContentLoaded", function () {
    Fancybox.bind("[data-fancybox]", {
        autoFocus: true,
    });

    //* АНИМАЦИЯ H2 */
    // Функция разбивки текста на буквы
    document.querySelectorAll('h2').forEach(h2 => {
        const letters = h2.textContent.split('');
        h2.textContent = '';
        letters.forEach((letter, i) => {
            const span = document.createElement('span');
            span.textContent = letter;
            span.style.transitionDelay = `${i * 0.05}s`; // задержка для каждой буквы
            h2.appendChild(span);
        });
    });

    // Отслеживаем появление заголовков
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll('h2').forEach(h2 => observer.observe(h2));

    const faqButtons = document.querySelectorAll(".faq-question");
    faqButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const parent = btn.closest(".faq-item");
            const icon = btn.querySelector(".faq-icon");
            const answer = parent.querySelector(".faq-answer");

            parent.classList.toggle("active");
            icon.classList.toggle("active");

            if (parent.classList.contains("active")) {
                answer.style.maxHeight = answer.scrollHeight + "px";

            } else {
                answer.style.maxHeight = null;

            }
        });
    });

    //плавный скролл

    function smoothScrollToElement(selector, duration = 700) {
        const target = document.querySelector(selector);
        if (!target) return;

        // Отключаем встроенный smooth scroll на время анимации
        document.documentElement.style.scrollBehavior = "auto";

        const element = document.scrollingElement || document.documentElement;
        const start = element.scrollTop;
        const targetTop = target.getBoundingClientRect().top + start - 160;
        const change = targetTop - start;
        const startTime = performance.now();

        function easeInOutQuad(t) {
            return t < 0.5
                ? 2 * t * t
                : -1 + (4 - 2 * t) * t;
        }

        function animateScroll(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeInOutQuad(progress);

            element.scrollTop = start + change * easedProgress;

            if (elapsed < duration) {
                requestAnimationFrame(animateScroll);
            } else {
                // Возвращаем поведение браузера обратно
                document.documentElement.style.scrollBehavior = "";
            }
        }

        requestAnimationFrame(animateScroll);
    }

    //  плавный скролл по клику на ссылку
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // убираем мгновенный прыжок
            smoothScrollToElement(this.getAttribute("href"), 800);
        });
    });

    // кнопка вверх
    const upArrow = document.querySelector('.arrow-up');


    function arrowUp() {

        if (upArrow) {
            upArrow.addEventListener('click', (e) => {
                e.preventDefault();
                smoothScrollToTop(800);
            });
        }

        // const arrow = document.querySelector('.arrow-up');
        if (!upArrow) return; // если кнопка не найдена — выходим

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                upArrow.classList.add('show');
            } else {
                upArrow.classList.remove('show');
            }
        });
    }

    arrowUp();

    // Универсальный плавный скролл к верху
    function smoothScrollToTop(duration = 700) {
        const element = document.scrollingElement || document.documentElement;
        const start = element.scrollTop;
        const change = -start;
        const startTime = performance.now();

        function easeInOutQuad(t) {
            return t < 0.5
                ? 2 * t * t
                : -1 + (4 - 2 * t) * t;
        }

        function animateScroll(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeInOutQuad(progress);

            element.scrollTop = start + change * easedProgress;

            if (elapsed < duration) {
                requestAnimationFrame(animateScroll);
            }
        }

        requestAnimationFrame(animateScroll);
    }

    const body = document.body;
    const menu = document.querySelector('.mobile-menu');
    const burger = document.querySelector('.menu-toggle');

    document.addEventListener('click', function (e) {
        // Клик по бургеру
        if (e.target.closest('.menu-toggle')) {
            e.stopPropagation();
            burger.classList.toggle('active');
            menu.classList.toggle('active');
            body.classList.toggle('_fixed');
            return;
        }

        // Клик по ссылке внутри меню
        if (e.target.closest('.mobile-menu .main-navigation a')) {
            burger.classList.remove('active');
            menu.classList.remove('active');
            body.classList.remove('_fixed');
            return;
        }

        // Клик вне меню и бургера
        if (!e.target.closest('.mobile-menu')) {
            burger.classList.remove('active');
            menu.classList.remove('active');
            body.classList.remove('_fixed');
        }
    });

    const menuItems = document.querySelectorAll('.menu-item-has-children');

    menuItems.forEach(item => {
        const link = item.querySelector('a');
        const dropdown = item.querySelector('.dropdown-menu');

        // Клик по ссылке
        link.addEventListener('click', (e) => {
            const isOpen = dropdown.classList.contains('show');

            // если меню ещё не открыто — открываем и предотвращаем переход
            if (!isOpen) {
                e.preventDefault();

                // закрываем все открытые меню
                document.querySelectorAll('.dropdown-menu.show').forEach(openDropdown => {
                    openDropdown.classList.remove('show');
                });
                dropdown.classList.add('show');
                body.classList.add('fixed');
            }
            // если уже открыто, второй клик — обычный переход
        });

        // Клик вне меню
        document.addEventListener('click', (event) => {
            if (!item.contains(event.target)) {
                dropdown.classList.remove('show');
                // если больше нет открытых меню — убираем класс с body
                if (!document.querySelector('.dropdown-menu.show')) {
                    body.classList.remove('fixed');
                }
            }
        });

        // Уход мыши с подменю
        dropdown.addEventListener('mouseleave', () => {
            dropdown.classList.remove('show');
            if (!document.querySelector('.dropdown-menu.show')) {
                body.classList.remove('fixed');
            }
        });
    });


});