document.addEventListener('DOMContentLoaded', function () {
    const tagLinks = document.querySelectorAll('.tag-link');
    const postsContainer = document.getElementById('ajax-posts');
    const loader = document.getElementById('loader');

    if (!tagLinks.length) return;

    // Хранит выбранные теги
    let selectedTags = new Set();

    tagLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const tagId = this.getAttribute('data-tag-id');

            // Если клик на "Показать все"
            if (tagId === 'all') {
                selectedTags.clear();
                tagLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            } else {
                // Убираем активный класс у "Показать все"
                document.querySelectorAll('.tag-link[data-tag-id="all"]').forEach(l => l.classList.remove('active'));

                // Переключаем активность тега
                if (selectedTags.has(tagId)) {
                    selectedTags.delete(tagId);
                    this.classList.remove('active');
                } else {
                    selectedTags.add(tagId);
                    this.classList.add('active');
                }
            }

            // Если не выбрано ни одного тега → показываем все
            const tagsArray = Array.from(selectedTags);
            const bodyData = tagsArray.length
                ? 'action=load_tagged_posts&tag_ids=' + encodeURIComponent(tagsArray.join(','))
                : 'action=load_tagged_posts&tag_ids=all';

            loader.style.display = 'block';
            postsContainer.innerHTML = '';

            fetch(ajaxurlObj.ajaxurl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: bodyData
            })
                .then(res => res.text())
                .then(html => {
                    loader.style.display = 'none';
                    postsContainer.innerHTML = html;
                })
                .catch(err => {
                    loader.style.display = 'none';
                    postsContainer.innerHTML = '<p>Ошибка загрузки.</p>';
                    console.error(err);
                });
        });
    });
});