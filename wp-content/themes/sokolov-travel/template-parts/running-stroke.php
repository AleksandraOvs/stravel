<?php
$strokes = carbon_get_theme_option('crb_rs_text');
?>

<?php if (!empty($strokes)) {
?>
    <div class="marquee">
        <div class="marquee__inner">
            <?php
            foreach ($strokes as $stroke) {
                echo '<p>' . $stroke['crb_rs_item'] . '</p>';
            }
            ?>
        </div>
    </div>
<?php
}
?>

<style>
    .marquee {
        overflow: hidden;
        position: relative;
        width: 100%;
        margin-bottom: 20px;
    }

    .marquee__inner {
        display: flex;
        width: max-content;
        animation: marquee 60s linear infinite;
    }

    .marquee {
        overflow: hidden;
        position: relative;
        width: 100%;
        padding: 5px 0;
        background: var(--accent);
        color: var(--black);
        letter-spacing: 1px;
    }

    .marquee__inner p {
        margin-right: 25px;
        display: flex;
        align-items: center;
        gap: 25px;
        position: relative;
        white-space: nowrap;
    }

    .marquee__inner p:after {
        content: '';
        width: 5px;
        height: 5px;
        border-radius: 100%;
        font-weight: 400;
        background: var(--black);
        display: block;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }
</style>

<script>
    const marquee = document.querySelector('.marquee');
    const inner = marquee.querySelector('.marquee__inner');

    // Клонируем элементы до тех пор, пока ширина inner не станет больше контейнера
    function makeMarqueeSeamless() {
        const containerWidth = marquee.offsetWidth;
        let totalWidth = inner.scrollWidth;

        // клонируем пока inner не превышает ширину контейнера * 2
        while (totalWidth < containerWidth * 2) {
            Array.from(inner.children).forEach(child => {
                inner.appendChild(child.cloneNode(true));
            });
            totalWidth = inner.scrollWidth;
        }
    }

    makeMarqueeSeamless();

    // Запуск анимации
    let speed = 1; // px за кадр
    let offset = 0;

    function animate() {
        offset += speed;
        if (offset >= inner.scrollWidth / 2) offset = 0; // зацикливаем
        inner.style.transform = `translateX(${-offset}px)`;
        requestAnimationFrame(animate);
    }

    animate();
</script>