<?php
add_action('wp_head', 'add_organization_jsonld');
function add_organization_jsonld()
{
    // на всех страницах
?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "@id": "https://example.ru/#org",
            "name": "<?php bloginfo('name'); ?>",
            "url": "<?php echo esc_url(home_url('/')); ?>",
            "logo": "<?php echo get_site_icon_url(); ?>",
            "image": ["https://example.ru/static/office.jpg"],
            "telephone": "+7-900-000-00-00",
            "email": "info@example.ru",
            "address": {
                "@type": "PostalAddress",
                "addressCountry": "RU",
                "addressLocality": "Москва",
                "streetAddress": "ул. Пример, 1"
            },
            "openingHours": "Mo-Fr 10:00-19:00",
            "sameAs": [
                "https://t.me/...",
                "https://vk.com/...",
                "https://www.youtube.com/@..."
            ],
            "contactPoint": [{
                "@type": "ContactPoint",
                "telephone": "+7-900-000-00-00",
                "contactType": "customer service",
                "areaServed": "RU",
                "availableLanguage": ["ru"]
            }]
        }
    </script>
<?php
}


add_action('wp_footer', 'add_breadcrumbs_jsonld');
function add_breadcrumbs_jsonld()
{
    if (is_front_page()) return; // не показываем на главной

    $breadcrumbs = [];
    $position = 1;

    // Главная
    $breadcrumbs[] = [
        "@type" => "ListItem",
        "position" => $position++,
        "name" => "Главная",
        "item" => home_url('/')
    ];

    // Если это страница (например, Услуги → конкретная)
    if (is_page() && $post = get_post()) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        foreach ($ancestors as $ancestor_id) {
            $breadcrumbs[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => get_the_title($ancestor_id),
                "item" => get_permalink($ancestor_id)
            ];
        }

        // Текущая страница
        $breadcrumbs[] = [
            "@type" => "ListItem",
            "position" => $position++,
            "name" => get_the_title($post->ID)
        ];
    }

    // Для записей (если есть рубрики)
    if (is_single() && $post = get_post()) {
        $categories = get_the_category($post->ID);
        if (!empty($categories)) {
            $main_cat = $categories[0];
            $breadcrumbs[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => $main_cat->name,
                "item" => get_category_link($main_cat->term_id)
            ];
        }
        $breadcrumbs[] = [
            "@type" => "ListItem",
            "position" => $position++,
            "name" => get_the_title($post->ID)
        ];
    }

    // Вывод JSON-LD
    if (!empty($breadcrumbs)) {
        $data = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $breadcrumbs
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}
