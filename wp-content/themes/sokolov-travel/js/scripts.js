document.addEventListener("DOMContentLoaded", function () {
    // === Fancybox (v4) + href="#main-form" ===
    if (typeof Fancybox !== "undefined") {
        Fancybox.bind("[data-fancybox]", { autoFocus: true });
    }

    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener("click", e => {
            const targetSelector = link.getAttribute("href");
            if (!targetSelector || targetSelector.length <= 1) return;

            // Если это форма для Fancybox
            if (targetSelector === "#main-form") {
                e.preventDefault();
                const target = document.querySelector(targetSelector);
                if (target) {
                    Fancybox.show([{ src: target, type: "inline" }]);
                }
                return; // не запускать плавный скролл
            }

            // Для остальных якорей — плавный скролл
            e.preventDefault();
            smoothScrollToElement(targetSelector, 800);
        });
    });

    // === Анимация H2 ===
    document.querySelectorAll("h2.title").forEach(h2 => {
        const text = h2.innerText;
        if (!text) return;
        h2.innerHTML = "";
        [...text].forEach((letter, i) => {
            const span = document.createElement("span");
            span.textContent = letter;
            span.style.transitionDelay = `${i * 0.05}s`;
            h2.appendChild(span);
        });
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add("animate");
        });
    }, { threshold: 0.2 });
    document.querySelectorAll("h2.title").forEach(h2 => observer.observe(h2));

    // === FAQ ===
    document.querySelectorAll(".faq-question").forEach(btn => {
        btn.addEventListener("click", () => {
            const parent = btn.closest(".faq-item");
            if (!parent) return;
            const icon = btn.querySelector(".faq-icon");
            const answer = parent.querySelector(".faq-answer");
            parent.classList.toggle("active");
            if (icon) icon.classList.toggle("active");
            if (answer) answer.style.maxHeight = parent.classList.contains("active") ? answer.scrollHeight + "px" : null;
        });
    });

    // === Универсальный плавный скролл ===
    function easeInOutQuad(t) { return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t; }

    function smoothScrollToElement(selector, duration = 700) {
        const target = document.querySelector(selector);
        if (!target) return;
        document.documentElement.style.scrollBehavior = "auto";
        const element = document.scrollingElement || document.documentElement;
        const start = element.scrollTop;
        const targetTop = target.getBoundingClientRect().top + start - 160;
        const change = targetTop - start;
        const startTime = performance.now();

        function animate(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            element.scrollTop = start + change * easeInOutQuad(progress);
            if (elapsed < duration) requestAnimationFrame(animate);
            else document.documentElement.style.scrollBehavior = "";
        }
        requestAnimationFrame(animate);
    }

    function smoothScrollToTop(duration = 700) {
        const element = document.scrollingElement || document.documentElement;
        const start = element.scrollTop;
        const change = -start;
        const startTime = performance.now();

        function animate(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            element.scrollTop = start + change * easeInOutQuad(progress);
            if (elapsed < duration) requestAnimationFrame(animate);
        }
        requestAnimationFrame(animate);
    }

    // === Кнопка "вверх" ===
    const upArrow = document.querySelector(".arrow-up");
    if (upArrow) {
        upArrow.addEventListener("click", e => { e.preventDefault(); smoothScrollToTop(800); });
        window.addEventListener("scroll", () => {
            upArrow.classList.toggle("show", window.scrollY > 300);
        });
    }

    // === Мобильное меню ===
    const body = document.body;
    const menu = document.querySelector(".mobile-menu");
    const burger = document.querySelector(".menu-toggle");
    document.addEventListener("click", function (e) {
        if (burger && e.target.closest(".menu-toggle")) {
            e.stopPropagation();
            burger.classList.toggle("active");
            if (menu) menu.classList.toggle("active");
            body.classList.toggle("_fixed");
            return;
        }
        if (menu && e.target.closest(".mobile-menu .main-navigation a")) {
            if (burger) burger.classList.remove("active");
            menu.classList.remove("active");
            body.classList.remove("_fixed");
            return;
        }
        if (menu && !e.target.closest(".mobile-menu") && burger) {
            burger.classList.remove("active");
            menu.classList.remove("active");
            body.classList.remove("_fixed");
        }
    });

    // === Подменю по наведению ===

    const menuItems = document.querySelectorAll(".menu-item-has-children");

    menuItems.forEach(item => {
        const link = item.querySelector("a");
        const dropdown = item.querySelector(".dropdown-menu");

        if (!link || !dropdown) return;

        // Показ при наведении
        item.addEventListener("mouseenter", () => {
            // Закрыть все открытые
            document.querySelectorAll(".dropdown-menu.show").forEach(open => open.classList.remove("show"));

            dropdown.classList.add("show");
            body.classList.add("fixed");
        });

        // Скрытие при уходе
        item.addEventListener("mouseleave", () => {
            dropdown.classList.remove("show");

            // Если нигде не открыто – разблокируем body
            if (!document.querySelector(".dropdown-menu.show")) {
                body.classList.remove("fixed");
            }
        });
    });

    // Клик вне меню — закрыть всё
    document.addEventListener("click", e => {
        if (!e.target.closest(".menu-item-has-children")) {
            document.querySelectorAll(".dropdown-menu.show").forEach(dropdown => dropdown.classList.remove("show"));
            body.classList.remove("fixed");
        }
    });

    // === Скрытие верхнего блока при скролле ===
    if (window.innerWidth > 992) {
        const headerTop = document.querySelector('.site-header__top-header');
        if (headerTop) {
            window.addEventListener('scroll', () => {
                headerTop.classList.toggle('hide', window.scrollY > 150);
            });
        }
    }


    var form = document.querySelector('form.wpcf7-form');
    if (form) {
        var pageTitleField = form.querySelector('input[name="page-title"]');
        if (pageTitleField) {
            pageTitleField.value = document.title;
        }
    }

});

document.addEventListener('wpcf7mailsent', function (event) {
    // Получаем текущий URL
    var currentPage = window.location.href;

    // Кодируем URL, чтобы корректно передать его параметром
    var redirectUrl = '/thank-you/?from=' + encodeURIComponent(currentPage);

    // Перенаправляем через 1 секунду (можно убрать задержку)
    setTimeout(function () {
        window.location.href = redirectUrl;
    }, 1000);
}, false);