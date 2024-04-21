<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

function create_lessons_posttype()
{
  register_post_type('lesson', [
    'labels' => [
      'name' => __('Lesson'),
      'singular_name' => __('Lessons'),
    ],
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => false,
  ]);
}

add_action('init', 'create_lessons_posttype');

add_action(
  'carbon_fields_register_fields',
  function () {
    Container::make('post_meta', __('Настройки поста'))
      ->where('post_type', '=', 'lesson')
      ->add_tab(__('Уроки'), [
        Field::make('complex', 'lessons', 'Уроки')
          ->set_visible_in_rest_api(true)
          ->set_layout('tabbed-vertical')
          ->add_fields([
            Field::make('text', 'lessons_title', 'Заголовок'),
            Field::make('text', 'lessons_description', 'Описание'),
            Field::make('complex', 'lesson_topics', 'Темы')
              ->set_layout('tabbed-vertical')
              ->add_fields([
                Field::make('text', 'lesson_lessons_title', 'Заголовок'),
                Field::make('rich_text', 'lesson_lessons_questions', 'Вопросы'),
                Field::make('complex', 'lesson_topic_books', 'Материал')
                  ->set_layout('tabbed-vertical')
                  ->add_fields([
                    Field::make(
                      'text',
                      'lesson_lessons_topic_books_title',
                      'Заголовок'
                    ),
                    Field::make(
                      'text',
                      'lesson_lessons_topic_books_description',
                      'Описание'
                    ),
                    Field::make(
                      'text',
                      'lesson_lessons_topic_books_start',
                      'Со страницы'
                    ),
                    Field::make(
                      'text',
                      'lesson_lessons_topic_books_end',
                      'До страницы'
                    ),
                    Field::make(
                      'file',
                      'lesson_lessons_topic_books_book',
                      __('Книга')
                    )->set_type(['application/pdf']),
                  ]),
              ]),
          ]),
      ]);
  },
  100
);
