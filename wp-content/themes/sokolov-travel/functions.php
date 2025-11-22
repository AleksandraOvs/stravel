<?php

/**
 * sokolov-travel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package stravel
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

// Настройки темы
function stravel_setup()
{

	load_theme_textdomain('stravel', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// включаем поддержку меню
	register_nav_menus(array(
		'menu-main'        => esc_html__('Primary', 'stravel'),
		'menu-footer'      => esc_html__('Footer menu', 'stravel'),
		'menu-footer2'      => esc_html__('Footer menu2', 'stravel'),
	));

	add_theme_support(
		'html5',
		array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script')
	);

	add_theme_support(
		'custom-background',
		array('default-color' => 'ffffff', 'default-image' => '')
	);
}
add_action('after_setup_theme', 'stravel_setup');



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stravel_content_width()
{
	$GLOBALS['content_width'] = apply_filters('stravel_content_width', 640);
}
add_action('after_setup_theme', 'stravel_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stravel_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'stravel'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Виджет для отображения на внутренних страницах', 'stravel'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Sidebar 1', 'stravel'),
		'id'            => 'footer-sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'stravel'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Sidebar 2', 'stravel'),
		'id'            => 'footer-sidebar-2',
		'description'   => esc_html__('Add widgets here.', 'stravel'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Sidebar 3', 'stravel'),
		'id'            => 'footer-sidebar-3',
		'description'   => esc_html__('Add widgets here.', 'stravel'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'stravel_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function stravel_scripts()
{

	wp_enqueue_style('fonts', get_stylesheet_directory_uri() . '/css/fonts.css', array(), time());
	wp_enqueue_style('swiper_styles', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css', array(), time());
	wp_enqueue_style('stravel-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('stravel-style', 'rtl', 'replace');

	wp_enqueue_script('swiper_scripts', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('stravel_slider_scripts', get_template_directory_uri() . '/js/slider-scripts.js', array(), _S_VERSION, true);

	wp_enqueue_script('filter_services', get_template_directory_uri() . '/js/posts-script.js', array(), _S_VERSION, true);

	// Передаём ajaxurlObj в скрипт
	wp_localize_script('filter_services', 'ajaxurlObj', array(
		'ajaxurl' => admin_url('admin-ajax.php')
	));

	// Подключаем библиотеку маски
	wp_enqueue_script(
		'jquery-mask',
		'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js',
		array('jquery'),
		'1.14.16',
		true
	);

	// Добавляем наш кастомный JS
	wp_add_inline_script('jquery-mask', "
        jQuery(document).ready(function($) {
            $('input[name=\"tel-202\"]').mask('+7 (000) 000-00-00');
        });
    ");


	// wp_register_script(
	// 	'posts-tags-script',
	// 	get_template_directory_uri() . '/js/posts-tags-script.js',
	// 	array(),
	// 	null,
	// 	true
	// );

	// Передаем ajaxurl в JS
	wp_localize_script('posts-tags-script', 'ajaxurlObj', array(
		'ajaxurl' => admin_url('admin-ajax.php')
	));

	//wp_enqueue_script('posts-tags-script');


	if (is_front_page() || is_home()) {
		wp_enqueue_script('stravel_numbers_scripts', get_template_directory_uri() . '/js/numbers.js', array(), _S_VERSION, true);
	}
	wp_enqueue_script('stravel-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('stravel-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), _S_VERSION, true);

	// Стили
	wp_enqueue_style(
		'fancybox',
		'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css',
		array(),
		null
	);

	// Скрипт
	wp_enqueue_script(
		'fancybox',
		'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js',
		array(), // можно добавить 'jquery' если нужно
		null,
		true // грузить в footer
	);


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'stravel_scripts');

function stravel_add_fetchpriority_css($tag, $handle, $href, $media)
{
	$critical_styles = array('stravel-style'); // сюда добавляем handle критических стилей
	if (in_array($handle, $critical_styles)) {
		$tag = '<link rel="stylesheet" id="' . $handle . '" href="' . $href . '" media="' . $media . '" fetchpriority="high">' . "\n";
	}
	return $tag;
}
add_filter('style_loader_tag', 'stravel_add_fetchpriority_css', 10, 4);

function stravel_add_fetchpriority_js($tag, $handle, $src)
{
	$critical_scripts = array('stravel-script', 'stravel-navigation'); // критические скрипты
	if (in_array($handle, $critical_scripts)) {
		$tag = '<script src="' . $src . '" fetchpriority="high"></script>' . "\n";
	}
	return $tag;
}
add_filter('script_loader_tag', 'stravel_add_fetchpriority_js', 10, 3);

function admin_styles()
{
	wp_enqueue_style(
		'admin-styles', // handle
		get_stylesheet_directory_uri() . '/css/admin-styles.css', // путь к файлу
		array(), // зависимости
		'1.0' // версия
	);
}
add_action('admin_enqueue_scripts', 'admin_styles');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
//require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/carbon-fields.php';
require get_template_directory() . '/inc/walker.php';
require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/custom-sidebar.php';
require get_template_directory() . '/inc/custom-pagination.php';
//require get_template_directory() . '/inc/microdata.php';
//require get_template_directory() . '/inc/cpt-thumbnails.php';
//require get_template_directory() . '/inc/nn-urls.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

//разрешить загрузку свг только админам
function allow_svg_upload_for_admins($mimes)
{
	if (current_user_can('administrator')) {
		$mimes['svg'] = 'image/svg+xml';
	}
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload_for_admins');

add_filter('template_include', 'var_template_include', 1000);
function var_template_include($t)
{
	$GLOBALS['current_theme_template'] = basename($t);
	return $t;
}

function get_current_template($echo = false)
{
	if (!isset($GLOBALS['current_theme_template']))
		return false;
	if ($echo)
		echo $GLOBALS['current_theme_template'];
	else
		return $GLOBALS['current_theme_template'];
}

// Contact Form 7 remove auto added p tags
add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('carbon_fields_sanitize_rich_text', function ($value) {
	return $value; // Сохраняем как есть, без wp_kses_post
});


## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
// add_filter('get_the_archive_title', function ($title) {
// 	return preg_replace('~^[^:]+: ~', '', $title);
// });
// Удаляет "Рубрика: ", "Метка: " и "Архивы" из заголовков архивов
add_filter('get_the_archive_title', function ($title) {
	// Убираем префиксы "Рубрика:", "Метка:", "Архивы" и т.п.
	$title = preg_replace('~^[^:]+:\s*~', '', $title);

	// Убираем слово "Архивы" (например, "Архивы: Проекты" → "Проекты")
	$title = preg_replace('~\bАрхивы\b[:\s]*~iu', '', $title);

	return $title;
});

function ch_remove_archive_from_title($title)
{
	// Убираем слово "Archive" из заголовка
	return str_replace('Archive', '', $title);
}
add_filter('wp_title', 'ch_remove_archive_from_title');
add_filter('pre_get_document_title', 'ch_remove_archive_from_title');


add_action('wp_ajax_filter_services', 'handle_filter_services_ajax');
add_action('wp_ajax_nopriv_filter_services', 'handle_filter_services_ajax');

function handle_filter_services_ajax()
{
	$term_id = isset($_POST['term_id']) ? intval($_POST['term_id']) : 0;

	$args = array(
		'post_type'      => 'services', // CPT services
		'posts_per_page' => -1,
	);

	if ($term_id && $term_id !== 'all') {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'services_cat', // правильный slug
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		);
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			get_template_part('template-parts/content-post');
		}
	} else {
		echo '<p>Посты не найдены.</p>';
	}

	wp_die();
}


// function my_excerpt_length($length)
// {
// 	return 20; // ← количество слов
// }
// add_filter('excerpt_length', 'my_excerpt_length');
