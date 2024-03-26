<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

// DOCS: https://docs.carbonfields.net/

add_action( 'carbon_fields_register_fields', function () {
    
    Container::make( 'theme_options', __( 'Настройки темы' ) )
    ->add_fields( array(
        Field::make( 'text', 'theme_email', 'Email' )->set_default_value('info@spichka.media'),
        Field::make( 'complex', 'theme_socials', 'Социальные сети' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
            Field::make( 'text', 'theme_social_link', 'Ссылка' ),
            Field::make( 'text', 'theme_social_icon', 'Иконка' ),
        ) ),
        Field::make( 'text', 'theme_telegram_channel', 'Телеграм канал' )->set_default_value( 'spichka_media' ),
        Field::make( 'image', 'theme_footer_image', 'Изображение' ),
        Field::make( 'text', 'theme_footer_text', 'Текст в футере' )->set_default_value( 'Авторские права никак не защищены и принадлежат народу. Но всё равно: ссылайтесь на нас, когда копируете наши материалы.' ),
    ) );

    Container::make( 'post_meta', __( 'Настройки поста' ) )
    ->where( 'post_type', '=', 'post' )
    ->add_tab( __( 'Комментарии' ), array(
        Field::make( 'checkbox', 'post_show_comments', 'Отображать комментарии' )->set_option_value('yes'),
        Field::make( 'text', 'post_telegram_post_id', __( 'Номер поста в Telegram' ) ),
    ) );

    Container::make( 'post_meta', __( 'Настройки главной страницы' ) )
    ->where( 'post_id', '=', get_option( 'page_on_front' ) )
    ->add_tab( __( 'Баннер' ), array(
        Field::make( 'text', 'front_banner_header', __( 'Заголовок' ) )->set_default_value( 'Марксистский журнал для умных, молодых и злых.'),
        Field::make( 'text', 'front_banner_description', __( 'Описание' ) )->set_default_value( 'Рассказываем просто и интересно про общество, политику, историю, экономику, культуру и философию.'),
        Field::make( 'file', 'front_banner_video', __( 'Видео' ) )->set_type( array( 'video' ) )->set_default_value(11703),
    ) )
    ->add_tab( __( 'Программные статьи' ), array(
        Field::make( 'text', 'front_program_articles_header', __( 'Заголовок' ) )->set_default_value( 'Программные статьи'),
        Field::make( 'association', 'front_program_articles', __( 'Статьи' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'post',
            )
        ) )
    ) )
    ->add_tab( __( 'Свежие статьи' ), array(
        Field::make( 'text', 'front_recent_articles_header', __( 'Заголовок' ) )->set_default_value( 'Свежие статьи'),
    ) )
    ->add_tab( __( 'Рубрики' ), array(
        Field::make( 'text', 'front_article_categories_header', __( 'Заголовок' ) )->set_default_value( 'Рубрики'),
    ) )
    ->add_tab( __( 'Присоеденяйся' ), array(
        Field::make( 'text', 'front_connect_header', __( 'Заголовок' ) )->set_default_value( 'Присоеденяйся'),
        Field::make( 'complex', 'front_connect_blocks', 'Блоки' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
            Field::make( 'text', 'front_connect_blocks_block_header', 'Заголовок' ),
            Field::make( 'text', 'front_connect_blocks_block_description', 'Описание' ),
            Field::make( 'text', 'front_connect_blocks_block_button_text', 'Текст на кнопке' ),
            Field::make( 'text', 'front_connect_blocks_block_form', 'Форма' ),
        ) ),
    ) )
    ->add_tab( __( 'Донать' ), array(
        Field::make( 'text', 'front_donate_header', __( 'Заголовок' ) )->set_default_value( 'Помогай'),
        Field::make( 'text', 'front_donate_description', __( 'Описание' ) )->set_default_value( 'Мы работаем над проектом в свободное время и на энтузиазме. Чтобы творить, нам нужно тратить деньги на сайт, покупать оборудование для видео и подкастов, снимать студии. Спасибо, что присылаете нам деньги — так нам реже приходится тратить свои.'),
        Field::make( 'text', 'front_donate_button_text', __( 'Текст на кнопке' ) )->set_default_value( 'Задонатить'),
        Field::make( 'image', 'front_donate_image', __( 'Изображение' ) ),
    ) );
}, 100);

if (class_exists("Carbon_Fields\Carbon_Fields")) {
    Carbon_Fields::boot();
}