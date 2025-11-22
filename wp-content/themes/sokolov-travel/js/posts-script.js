document.addEventListener('DOMContentLoaded', function () {
    console.log('JS загружен!');
    console.log(ajaxurlObj.ajaxurl); // для проверки

    // Находим все ссылки внутри #category-filter
    const links = document.querySelectorAll('#category-filter a');

    links.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const termId = this.dataset.term; // data-term

            // Устанавливаем класс active на кликнутую ссылку
            links.forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // Показать прелоадер
            document.querySelector('#posts-list').innerHTML = '<div class="loader"></div>';

            // Собираем данные
            const formData = new FormData();
            formData.append('action', 'filter_services');
            formData.append('term_id', termId);

            // Отправляем AJAX через fetch
            fetch(ajaxurlObj.ajaxurl, {
                method: 'POST',
                body: formData
            })
                .then(response => response.text()) // WordPress вернёт HTML
                .then(html => {
                    document.querySelector('#posts-list').innerHTML = html;
                })
                .catch(err => {
                    console.error('Ошибка:', err);
                });
        });
    });




});