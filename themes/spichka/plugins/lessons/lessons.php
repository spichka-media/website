<?php
/*
Plugin Name: Lessons Plugin
Version: 0.0.1
*/

register_activation_hook(__FILE__, 'child_plugin_activate');
function child_plugin_activate()
{
  // Require parent plugin
  if (
    !is_plugin_active('carbon-fields/carbon-fields-plugin.php') and
    current_user_can('activate_plugins')
  ) {
    // Stop activation redirect and show error
    wp_die(
      'Sorry, but this plugin requires the Parent Plugin to be installed and active. <br><a href="' .
        admin_url('plugins.php') .
        '">&laquo; Return to Plugins</a>'
    );
  }
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

function create_modules_post_type()
{
  register_post_type('module', [
    'labels' => [
      'name' => __('Lesson modules'),
      'singular_name' => __('Lesson module'),
    ],
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => false,
  ]);
}

add_action('init', 'create_modules_post_type');

add_action(
  'carbon_fields_register_fields',
  function () {
    Container::make('post_meta', __('Настройки поста'))
      ->where('post_type', '=', 'module')
      ->add_tab(__('Уроки'), [
        Field::make('complex', 'lessons', 'Уроки')
          ->set_visible_in_rest_api(true)
          ->set_layout('tabbed-vertical')
          ->add_fields([
            Field::make('text', 'title', 'Заголовок'),
            Field::make('text', 'description', 'Описание'),
            Field::make('complex', 'topics', 'Темы')
              ->set_layout('tabbed-vertical')
              ->add_fields([
                Field::make('text', 'title', 'Заголовок'),
                Field::make('complex', 'resources', 'Материал')
                  ->set_layout('tabbed-vertical')
                  ->add_fields([
                    Field::make('text', 'title', 'Заголовок'),
                    Field::make(
                      'text',
                      'document_page_start',
                      'Со страницы'
                    )->set_attribute('type', 'number'),
                    Field::make(
                      'text',
                      'document_page_end',
                      'До страницы'
                    )->set_attribute('type', 'number'),
                    Field::make('file', 'document', __('Книга'))->set_type([
                      'application/pdf',
                    ]),
                    Field::make('rich_text', 'text', 'Текст'),
                  ]),
              ]),
          ]),
      ]);
  },
  100
);
