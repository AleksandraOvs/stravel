<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;



add_action('carbon_fields_register_fields', 'site_carbon');
function site_carbon()
{
    Container::make('theme_options', 'Контакты')

        ->set_page_menu_position(2)
        ->set_icon('dashicons-megaphone')
        ->add_tab(__('Контакты'), [

            Field::make('image', 'crb_address_icon', 'Иконка')
                ->set_width(50),
            Field::make('rich_text', 'crb_address', 'Адреса')
                ->set_width(50),


            Field::make('complex', 'crb_links', 'Инфо-ссылки')
                ->help_text('Ссылки для отображения информации в header и footer')
                ->add_fields(array(
                    Field::make('image', 'crb_link_icon', 'Иконка')
                        ->set_width(33),
                    Field::make('text', 'crb_link_text', 'Текст ссылки')
                        ->set_width(33),
                    Field::make('text', 'crb_link', 'Ссылка')
                        ->set_width(33),
                )),

            Field::make('complex', 'crb_contacts', 'Мессенджеры')
                ->add_fields(array(
                    Field::make('image', 'crb_contact_image', 'Иконка')
                        ->set_width(33),
                    Field::make('text', 'crb_contact_name', 'Название')
                        ->set_width(33),
                    Field::make('text', 'crb_contact_link', 'Ссылка')
                        ->set_width(33),
                )),

            Field::make('text', 'crb_button_text', 'Кнопка')
                ->set_width(50),
            Field::make('text', 'crb_button_link', 'Ссылка кнопки')
                ->set_width(50)
                ->set_default_value('#main-form'),
        ])

        ->add_tab(__('Бегущая строка'), [
            Field::make('complex', 'crb_rs_text', 'Элементы бегущей строки')
                ->add_fields(array(
                    Field::make('text', 'crb_rs_item', 'Фраза для бегущей строки')
                        ->set_width(33),
                )),
        ])

        ->add_tab(__('Код карты'), [
            Field::make('text', 'crb_map_code', 'Код карты'),
            Field::make('rich_text', 'crb_map_text', 'Текстовая область блока карты')
        ])

        ->add_tab(__('Формы обратной связи'), [

            Field::make('text', 'crb_mainform_shortcode', 'Шорткод для главной формы обратной связи'),

            Field::make('rich_text', 'crb_main_form_head', 'Заголовок формы')
                ->set_width(50),
            Field::make('image', 'crb_main_form_img', 'Изображение')
                ->set_width(50),
            Field::make('text', 'crb_main_form_link', 'Ссылка')
                ->set_default_value('#main-form')
                ->set_width(50),
            Field::make('text', 'crb_main_form_text', 'Текст ссылки')
                ->set_default_value('Оставить заявку')
                ->set_width(50),

            Field::make('text', 'crb_form_head', 'Заголвок формы')
                ->set_width(33),
            Field::make('rich_text', 'crb_form_desc', 'Описание формы')
                ->set_width(33),
            Field::make('text', 'crb_form_shortcode', 'Шорткод для формы обратной связи(2)')
                ->set_width(33),
        ]);

    Container::make('post_meta', 'Контент главной страницы')
        ->where('post_id', '=', get_option('page_on_front')) // условие

        ->add_tab('Главная страница', array(
            Field::make('complex', 'crb_dest_hero_slider', 'Слайды первого экрана')
                ->set_layout('tabbed-horizontal') // красиво оформляет слайды
                ->help_text('Добавьте несколько слайдов для первого экрана')
                ->add_fields('slide', array(

                    Field::make('image', 'image', 'Изображение')
                        ->set_width(33),

                    Field::make('text', 'alt', 'Alt изображения')
                        ->set_width(33),

                    Field::make('text', 'title', 'Заголовок')
                        ->set_width(50),

                    Field::make('rich_text', 'subtitle', 'Подзаголовок')
                        ->set_width(50),

                )),

            Field::make('association', 'front_calendar_posts', 'Посты для блока "Актуальное"')
                ->set_types([
                    [
                        'type'      => 'post',
                        'post_type' => 'post',
                        'taxonomy'  => 'category:calendar', // только посты категории calendar
                    ],
                ])
                ->set_min(0)
                ->set_max(8)
                ->help_text('Выберите посты, которые должны отображаться в разделе "Актуальное"'),
        ))

        ->add_tab('О компании', array(
            Field::make('text', 'crb_about_head', 'Заголовок блока')
                ->set_width(33),
            Field::make('rich_text', 'crb_about_desc', 'Подзаголовок блока')
                ->set_width(33),
            Field::make('rich_text', 'crb_about_text_accent', 'Акцентный текст')
                ->set_width(33),
            Field::make('complex', 'crb_about_nums', 'Цифры о компании')
                ->add_fields('about_num', 'Цифра', [
                    Field::make('text', 'crb_about_num', 'Цифра')
                        ->set_width(50),
                    Field::make('text', 'crb_about_num_desc', 'Описание')
                        ->set_width(50),
                ])
        ))

        ->add_tab('Преимущества', array(
            Field::make('text', 'crb_advs_head', 'Заголовок блока')
                ->set_width(50),
            Field::make('image', 'crb_advs_img', 'Изображение')
                ->help_text('Изображние размером 350х350пикс.')
                ->set_width(50),

            Field::make('complex', 'crb_advs_items', 'Список преимуществ')
                ->set_layout('tabbed-vertical')
                ->add_fields('about_num', 'Преимущество', [
                    Field::make('text', 'crb_adv_item_head', 'Заголовок преимущества')
                        ->set_width(33),
                    Field::make('rich_text', 'crb_adv_item_desc', 'Описание преимущества')
                        ->set_width(33),
                    Field::make('image', 'crb_adv_item_icon', 'Иконка преимущства')
                        ->set_width(33),
                ])
        ))

        ->add_tab('FAQ', array(
            Field::make('rich_text', 'crb_faq_description', 'Текстовая область'),
            Field::make('complex', 'crb_faq', 'Вопросы и ответы')
                ->set_layout('tabbed-vertical')
                ->add_fields('faq_item', 'FAQ элемент', array(
                    Field::make('text', 'question', 'Вопрос')
                        ->set_width(50),
                    Field::make('rich_text', 'answer', 'Ответ')
                        ->set_width(50),
                ))
        ))

        ->add_tab('Блок контактов', array(
            Field::make('text', 'crb_contact-block_head', 'Заголовок блока'),
            Field::make('rich_text', 'crb_contact-block_description', 'Текстовая область'),
            Field::make('image', 'crb_contact-block_bg', 'Изображение для фона'),
        ));
}
