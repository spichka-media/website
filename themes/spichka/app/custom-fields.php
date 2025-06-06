<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

// DOCS: https://docs.carbonfields.net/

add_action(
  'carbon_fields_register_fields',
  function () {
    Container::make('theme_options', 'Настройки темы')->add_fields([
      Field::make('text', 'theme_email', 'Email'),
      Field::make('complex', 'theme_socials', 'Социальные сети')
        ->set_layout('tabbed-horizontal')
        ->add_fields([
          Field::make('text', 'theme_social_link', 'Ссылка'),
          Field::make('text', 'theme_social_icon', 'Иконка'),
        ]),
      Field::make('text', 'theme_telegram_channel', 'Телеграм канал'),
      Field::make('image', 'theme_footer_image', 'Изображение по умолчанию'),
      Field::make(
        'text',
        'theme_footer_image_quote',
        'Текст к изображению по умолчанию'
      ),
      Field::make('complex', 'theme_portraits', 'Портреты')
        ->set_layout('tabbed-vertical')
        ->add_fields([
          Field::make('file', 'static_image', 'Изображение в покое')
            ->set_type('image')
            ->set_value_type('url'),
          Field::make('text', 'alt', 'Атрибут alt'),
          Field::make('file', 'extra_image', 'Дополнительное изображение')
            ->set_type('image')
            ->set_value_type('url'),
          Field::make('complex', 'quotes', 'Цитаты')
            ->set_layout('tabbed-horizontal')
            ->add_fields([Field::make('text', 'quote', 'Цитата')])
            ->set_help_text(
              'Важно иметь у всех портретов одинаковое количество цитат (особенности реализации)'
            ),
        ]),
      Field::make('rich_text', 'theme_footer_text', 'Текст в футере'),
      Field::make(
        'text',
        'recommended_posts_title',
        'Заголовок блока рекомендаций'
      ),
      Field::make(
        'file',
        'posts_more_image',
        'Изображение для "Больше статей"'
      )->set_type(['image']),
      Field::make(
        'file',
        'notes_more_image',
        'Изображение для "Больше заметок"'
      )->set_type(['image']),
      Field::make(
        'complex',
        'theme_call_to_action',
        'Telegram-блок под статьей (Добавьте два элемента)'
      )
        ->set_layout('tabbed-vertical')
        ->set_max(2)
        ->add_fields([
          Field::make('text', 'title', 'Заголовок'),
          Field::make('text', 'description', 'Описание'),
          Field::make('file', 'video', 'Видео')->set_type('video'),
          Field::make('text', 'button_text', 'Текст кнопки'),
          Field::make('file', 'button_icon', 'Иконка кнопки')->set_type(
            'image'
          ),
        ])->set_header_template('
          <% if ($_index) { %>
              Без номера поста
          <% } else { %>
              С номером поста Telegram в статье
          <% } %>
        '),
      Field::make(
        'text',
        'author_foreign_agent_prevention_text',
        'Текст пометки иноагента'
      ),
    ]);

    Container::make('post_meta', 'Настройки поста')
      ->where('post_type', 'IN', ['post', 'note'])
      ->add_tab('Комментарии', [
        Field::make(
          'checkbox',
          'post_show_comments',
          'Отображать комментарии'
        )->set_option_value('yes'),
        Field::make('text', 'post_telegram_post_id', 'Номер поста в Telegram'),
      ])
      ->add_tab('Рекомендованные статьи', [
        Field::make('association', 'recommended_posts', 'Статьи')->set_types([
          [
            'type' => 'post',
            'post_type' => 'post',
          ],
        ]),
      ])
      ->add_tab('Переводы статьи', [
        Field::make('association', 'translated_posts', 'Статьи')->set_types([
          [
            'type' => 'post',
            'post_type' => 'post',
          ],
        ]),
      ]);

    Container::make('post_meta', 'Настройки')
      ->where('post_template', '=', 'template-about-us.blade.php')
      ->add_tab('Баннер', [
        Field::make('rich_text', 'banner_title', 'Заголовок'),
        Field::make('rich_text', 'banner_description', 'Описание'),
        Field::make('image', 'banner_image', 'Изображение'),
      ])
      ->add_tab('О нас', [
        Field::make('text', 'about_title', 'Заголовок'),
        Field::make('rich_text', 'about_description', 'Описание'),
        Field::make('image', 'about_decoration', 'Изображение на мобильном'),
      ])
      ->add_tab('Статьи', [Field::make('text', 'articles_title', 'Заголовок')])
      ->add_tab('Присоеденяйся', [
        Field::make('text', 'join_title', 'Заголовок'),
        Field::make('rich_text', 'join_description', 'Описание'),
        Field::make('text', 'join_button_text', 'Текст на кнопке'),
        Field::make('text', 'join_button_link', 'Ссылка на кнопке'),
        Field::make('image', 'join_decoration', 'Изображение на мобильном'),
      ])
      ->add_tab('Поддержи', [
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
      ->add_tab('Футер', [
        Field::make('image', 'footer_pattern', 'Паттерн'),
        Field::make('text', 'footer_title', 'Заголовок'),
      ]);

    Container::make('post_meta', 'Настройки главной страницы')
      ->where('post_id', '=', get_option('page_on_front'))
      ->add_tab('Баннер', [
        Field::make('rich_text', 'front_banner_header', 'Заголовок'),
        Field::make('text', 'front_banner_description', 'Описание'),
        Field::make('file', 'front_banner_video', 'Видео')->set_type(['video']),
        Field::make('image', 'front_banner_video_poster', 'Постер к Видео'),
      ])
      ->add_tab('Программные статьи', [
        Field::make('text', 'front_program_articles_header', 'Заголовок'),
        Field::make(
          'association',
          'front_program_articles',
          'Статьи'
        )->set_types([
          [
            'type' => 'post',
            'post_type' => 'post',
          ],
        ]),
        Field::make(
          'association',
          'front_program_articles_taxonomy',
          'Категория для перехода'
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
      ->add_tab('Свежие статьи', [
        Field::make('text', 'front_recent_articles_header', 'Заголовок'),
      ])
      ->add_tab('Свежие заметки', [
        Field::make('text', 'front_recent_notes_header', 'Заголовок'),
      ])
      ->add_tab('Рубрики', [
        Field::make('text', 'front_article_categories_header', 'Заголовок'),
        Field::make(
          'association',
          'front_article_categories',
          'Категории'
        )->set_types([
          [
            'type' => 'term',
            'taxonomy' => 'category',
          ],
        ]),
      ])
      ->add_tab('Присоединяйся', [
        Field::make('text', 'front_connect_header', 'Заголовок'),
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
            Field::make('text', 'front_connect_blocks_block_link', 'Ссылка'),
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
      ->add_tab('Донать', [
        Field::make('text', 'front_donate_header', 'Заголовок'),
        Field::make('text', 'front_donate_description', 'Описание'),
        Field::make('text', 'front_donate_button_text', 'Текст на кнопке'),
        Field::make('text', 'front_donate_button_link', 'Ссылка'),
        Field::make('image', 'front_donate_image', 'Изображение'),
      ]);
  },
  100
);

if (class_exists('Carbon_Fields\Carbon_Fields')) {
  Carbon_Fields::boot();
}

add_action('rest_api_init', function () {
  register_rest_route('custom-fields', 'theme_options', [
    'methods' => 'GET',
    'callback' => function () {
      $theme_options = [
        'theme_portraits' => carbon_get_theme_option('theme_portraits'),
      ];

      $response = rest_ensure_response($theme_options);

      return $response;
    },
    'permission_callback' => function () {
      return 'public_allowed';
    },
  ]);
});

add_action('carbon_fields_theme_options_container_saved', function () {
  if (!class_exists('CF\WordPress\Hooks')) {
    return;
  }

  $cf_hooks = new CF\WordPress\Hooks();
  $cf_hooks->purgeCacheEverything();
});
