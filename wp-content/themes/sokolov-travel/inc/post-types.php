<?php

add_action('init', 'register_post_types');

function register_post_types()
{

    register_post_type('services', [
        'label'  => null,
        'labels' => [
            'name'               => 'Услуги', // основное название для типа записи
            'singular_name'      => 'Услуга', // название для одной записи этого типа
            'add_new'            => 'Добавить услугу', // для добавления новой записи
            'add_new_item'       => 'Добавление услуги', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать', // для редактирования типа записи
            'new_item'           => 'Новая услуга', // текст новой записи
            'view_item'          => 'Перейти', // для просмотра записи этого типа.
            'search_items'       => 'Искать услугу', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Услуги', // название меню
        ],
        'description'            => '',
        'public'                 => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        'show_in_nav_menus'   =>  true, // зависит от public
        'show_in_menu'           => true, // показывать ли в меню админки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest'        => true, // добавить в REST API. C WP 4.7
        'rest_base'           => false, // $post_type. C WP 4.7
        'menu_position'       => 2,
        'menu_icon' => get_template_directory_uri() . '/images/svg/services.svg',
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => true,
        'supports'            => ['title', 'thumbnail', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        //'taxonomies'          => false,
        'has_archive'         => true,
        //'rewrite'             => true,
        'rewrite' => [
            'slug' => 'services',
            'with_front' => false,
        ],
        'query_var'           => 'services',
    ]);

    // Регистрируем таксономию services_cat
    register_taxonomy('services_cat', ['services'], [
        'labels' => [
            'name'              => 'Категории услуг',
            'singular_name'     => 'Категория услуг',
            'search_items'      => 'Найти категорию',
            'all_items'         => 'Все категории',
            'parent_item'       => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item'         => 'Редактировать категорию',
            'update_item'       => 'Обновить категорию',
            'add_new_item'      => 'Добавить новую категорию',
            'new_item_name'     => 'Название новой категории',
            'menu_name'         => 'Категории',
        ],
        'hierarchical'      => true, // делаем как рубрики (true) или как метки (false)
        'show_in_rest'      => true, // поддержка Gutenberg и REST API
        'show_admin_column' => true,
        'rewrite'           => [
            'slug' => 'services-category',
            'with_front' => false,
        ],
    ]);

    // CPT: Команда
    register_post_type('team', [
        'label'  => null,
        'labels' => [
            'name'               => 'Наша команда',
            'singular_name'      => 'Сотрудник',
            'add_new'            => 'Добавить сотрудника',
            'add_new_item'       => 'Добавление сотрудника',
            'edit_item'          => 'Редактировать',
            'new_item'           => 'Новый сотрудник',
            'view_item'          => 'Перейти',
            'search_items'       => 'Искать сотрудника',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Команда',
        ],
        'public'             => true,
        'show_in_nav_menus'  => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_position'      => 3,
        'menu_icon'          => get_template_directory_uri() . '/images/svg/team.svg',
        'hierarchical'       => false,
        'supports'           => ['title', 'thumbnail', 'editor', 'excerpt'],
        'taxonomies'         => ['post_tag'], // только теги
        'has_archive' => 'team',
        'rewrite' => [
            'slug' => 'team',
            'with_front' => false,
        ],
        'query_var'          => 'team',
    ]);
}
