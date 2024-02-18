<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

add_action( 'carbon_fields_register_fields', function () {
    
    Container::make( 'theme_options', __( 'Theme Options' ) )
    ->add_fields( array(
        Field::make( 'text', 'theme_email', 'Email' )->set_default_value('info@spichka.media'),
        Field::make( 'complex', 'theme_socials', 'Socials' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
            Field::make( 'text', 'theme_social_link', 'Link' ),
            Field::make( 'text', 'theme_social_icon', 'Icon' ),
        ) ),
      Field::make( 'text', 'theme_footer_text', 'Footer text' )->set_default_value( 'Авторские права никак не защищены и принадлежат народу. Но всё равно: ссылайтесь на нас, когда копируете наши материалы.' ),
    ) );

    Container::make( 'post_meta', __( 'Options' ) )
    ->where( 'post_id', '=', get_option( 'page_on_front' ) )
    ->add_tab( __( 'Программные статьи' ), array(
        Field::make( 'text', 'front_program_articles_header', __( 'Заголовок' ) )->set_default_value( 'Программные статьи'),
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
    ->add_tab( __( 'Donate' ), array(
        Field::make( 'text', 'front_donate_header', __( 'Заголовок' ) )->set_default_value( 'Помогай'),
        Field::make( 'text', 'front_donate_description', __( 'Описание' ) )->set_default_value( 'Мы работаем над проектом в свободное время и на энтузиазме. Чтобы творить, нам нужно тратить деньги на сайт, покупать оборудование для видео и подкастов, снимать студии. Спасибо, что присылаете нам деньги — так нам реже приходится тратить свои.'),
        Field::make( 'text', 'front_donate_button_text', __( 'Текст на кнопке' ) )->set_default_value( 'Задонатить'),
        Field::make( 'image', 'front_donate_image', __( 'Изображение' ) ),
    ) );
}, 100);


Carbon_Fields::boot();
