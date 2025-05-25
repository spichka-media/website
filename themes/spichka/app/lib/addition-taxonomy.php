<?php
add_action('init', function(){
    register_taxonomy(
        'translation_lang',
        ['post', 'note'],
        [
            'labels'                => [
                'name'              => 'Языки',
                'singular_name'     => 'Язык',
                'search_items'      => 'Поиск языка',
                'all_items'         => 'Все языки',
                'view_item '        => 'Посмотреть язык',
                'parent_item'       => 'Родительский язык',
                'parent_item_colon' => 'Язык',
                'edit_item'         => 'Редактировать язык',
                'update_item'       => 'Обновить язык',
                'add_new_item'      => 'Добавить язык',
                'new_item_name'     => '',
                'menu_name'         => 'Языки',
                'back_to_items'     => '← Оратно к языку',
            ],
            'description'           => 'Языки статей',
            'public'                => true,
            'hierarchical'          => false,
            'show_in_rest'          => true,
            'default_term'          => 'ru'
        ]
    );
});
