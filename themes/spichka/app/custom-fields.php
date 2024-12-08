<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

// DOCS: https://docs.carbonfields.net/

add_action(
  'carbon_fields_register_fields',
  function () {
    Container::make('theme_options', __('Настройки темы'))->add_fields([
      Field::make('text', 'theme_email', 'Email'),
      Field::make('complex', 'theme_socials', 'Социальные сети')
        ->set_layout('tabbed-horizontal')
        ->add_fields([
          Field::make('text', 'theme_social_link', 'Ссылка'),
          Field::make('text', 'theme_social_icon', 'Иконка'),
        ]),
      Field::make('text', 'theme_telegram_channel', 'Телеграм канал'),
      Field::make('image', 'theme_footer_image', 'Изображение'),
      Field::make('rich_text', 'theme_footer_text', 'Текст в футере'),
      Field::make(
        'text',
        'recommended_posts_title',
        'Заголовок блока рекомендаций'
      ),
      Field::make(
        'file',
        'posts_more_image',
        __('Изображение для "Больше статей')
      )->set_type(['image']),
    ]);

    Container::make('post_meta', __('Настройки поста'))
      ->where('post_type', 'IN', ['post', 'note'])
      ->add_tab(__('Комментарии'), [
        Field::make(
          'checkbox',
          'post_show_comments',
          'Отображать комментарии'
        )->set_option_value('yes'),
        Field::make(
          'text',
          'post_telegram_post_id',
          __('Номер поста в Telegram')
        ),
      ])
      ->add_tab(__('Рекомендованные статьи'), [
        Field::make(
          'association',
          'recommended_posts',
          __('Статьи')
        )->set_types([
          [
            'type' => 'post',
            'post_type' => 'post',
          ],
        ]),
      ]);

    Container::make('post_meta', __('Настройки'))
      ->where('post_template', '=', 'template-about-us.blade.php')
      ->add_tab(__('Баннер'), [
        Field::make('rich_text', 'banner_title', 'Заголовок'),
        Field::make('rich_text', 'banner_description', 'Описание'),
        Field::make('image', 'banner_image', 'Изображение'),
      ])
      ->add_tab(__('О нас'), [
        Field::make('text', 'about_title', 'Заголовок'),
        Field::make('rich_text', 'about_description', 'Описание'),
        Field::make('image', 'about_decoration', 'Изображение на мобильном'),
      ])
      ->add_tab(__('Статьи'), [
        Field::make('text', 'articles_title', 'Заголовок'),
      ])
      ->add_tab(__('Присоеденяйся'), [
        Field::make('text', 'join_title', 'Заголовок'),
        Field::make('rich_text', 'join_description', 'Описание'),
        Field::make('text', 'join_button_text', 'Текст на кнопке'),
        Field::make('text', 'join_button_link', 'Ссылка на кнопке'),
        Field::make('image', 'join_decoration', 'Изображение на мобильном'),
      ])
      ->add_tab(__('Поддержи'), [
        Field::make('text', 'support_title', 'Заголовок'),
        Field::make('text', 'support_block_1_title', 'Заголовок блок 1'),
        Field::make(
          'rich_text',
          'support_block_1_description',
          'Описание блок 1'
        ),
        Field::make(
          'text',
          'support_block_1_button_text',
          'Текст на кнопке блок 1'
        ),
        Field::make(
          'text',
          'support_block_1_button_link',
          'Ссылка на кнопке блок 1'
        ),
        Field::make('text', 'support_block_2_title', 'Заголовок блок 2'),
        Field::make(
          'rich_text',
          'support_block_2_description',
          'Описание блок 2'
        ),
        Field::make(
          'text',
          'support_block_2_button_text',
          'Текст на кнопке блок 2'
        ),
        Field::make(
          'text',
          'support_block_2_button_link',
          'Ссылка на кнопке блок 2'
        ),
        Field::make('image', 'support_image', 'Изображение'),
        Field::make('image', 'support_decoration', 'Декорация на мобильном'),
      ])
      ->add_tab(__('Футер'), [
        Field::make('image', 'footer_pattern', 'Паттерн'),
        Field::make('text', 'footer_title', 'Заголовок'),
      ]);

    Container::make('post_meta', __('Настройки главной страницы'))
      ->where('post_id', '=', get_option('page_on_front'))
      ->add_tab(__('Баннер'), [
        Field::make('rich_text', 'front_banner_header', __('Заголовок')),
        Field::make('text', 'front_banner_description', __('Описание')),
        Field::make('file', 'front_banner_video', __('Видео'))->set_type([
          'video',
        ]),
        Field::make('image', 'front_banner_video_poster', __('Постер к Видео')),
      ])
      ->add_tab(__('Программные статьи'), [
        Field::make('text', 'front_program_articles_header', __('Заголовок')),
        Field::make(
          'association',
          'front_program_articles',
          __('Статьи')
        )->set_types([
          [
            'type' => 'post',
            'post_type' => 'post',
          ],
        ]),
        Field::make(
          'association',
          'front_program_articles_taxonomy',
          __('Категория для перехода')
        )
          ->set_types([
            [
              'type' => 'term',
              'taxonomy' => 'category',
            ],
          ])
          ->set_min(1)
          ->set_max(1),
      ])
      ->add_tab(__('Свежие статьи'), [
        Field::make('text', 'front_recent_articles_header', __('Заголовок')),
      ])
      ->add_tab(__('Рубрики'), [
        Field::make('text', 'front_article_categories_header', __('Заголовок')),
        Field::make(
          'association',
          'front_article_categories',
          __('Категории')
        )->set_types([
          [
            'type' => 'term',
            'taxonomy' => 'category',
          ],
        ]),
      ])
      ->add_tab(__('Присоединяйся'), [
        Field::make('text', 'front_connect_header', __('Заголовок')),
        Field::make('complex', 'front_connect_blocks', 'Блоки')
          ->set_layout('tabbed-horizontal')
          ->add_fields([
            Field::make(
              'text',
              'front_connect_blocks_block_header',
              'Заголовок'
            ),
            Field::make(
              'rich_text',
              'front_connect_blocks_block_description',
              'Описание'
            ),
            Field::make(
              'text',
              'front_connect_blocks_block_button_text',
              'Текст на кнопке'
            ),
            Field::make(
              'text',
              'front_connect_blocks_block_link',
              __('Ссылка')
            ),
            Field::make(
              'color',
              'front_connect_blocks_block_background_color',
              'Цвет фона'
            ),
            Field::make(
              'color',
              'front_connect_blocks_block_color',
              'Цвет текста'
            ),
          ]),
      ])
      ->add_tab(__('Донать'), [
        Field::make('text', 'front_donate_header', __('Заголовок')),
        Field::make('text', 'front_donate_description', __('Описание')),
        Field::make('text', 'front_donate_button_text', __('Текст на кнопке')),
        Field::make('text', 'front_donate_button_link', 'Ссылка'),
        Field::make('image', 'front_donate_image', __('Изображение')),
      ]);
  },
  100
);

if (class_exists('Carbon_Fields\Carbon_Fields')) {
  Carbon_Fields::boot();
}
