@extends('layouts.app')

@section('content')
  <section class="section-banner-video">
    <video class="banner-video" autoplay muted playsinline loop>
      <source src="https://spichka.media/wp-content/uploads/2020/12/%D1%81%D0%BF%D0%B8%D1%87%D0%BA%D0%B8.mp4"
        type="video/mp4">
    </video>

    <div class="container">
      <div class="header">
        <div class="row">
          <div class="col-sm-6">
            <h1>Марксистский журнал для умных, молодых и злых.</h1>
            <p>Рассказываем просто и интересно про общество, политику, историю, экономику, культуру и философию.
          </div>
        </div>
        </p>
      </div>
    </div>
  </section>

  <section class="program-articles">
    <div class="container">
      <h2>
        Программные статьи
      </h2>
    </div>

    <div class="container-fluid">
      @php
        // the query
        $program_posts = get_posts([
            'posts_per_page' => 10,
        ]);
      @endphp
      <div class="glide">
        <div data-glide-el="track" class="glide__track">
          <ul class="glide__slides">
            @foreach ($program_posts as $post)
              <li class="glide__slide">
                <x-post-card title="{{ get_the_title($post->ID) }}" :thumbnail="get_the_post_thumbnail($post->ID, 'post-card')" :url="get_post_permalink($post->ID)" />
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="program-articles">
    <div class="container">
      <h2>
        Свежие статьи
      </h2>
    </div>

    <div class="container-fluid">
      @php
        // the query
        $recent_posts = get_posts([
            'posts_per_page' => 10,
        ]);
      @endphp
      <div class="glide">
        <div data-glide-el="track" class="glide__track">
          <ul class="glide__slides">
            @foreach ($recent_posts as $post)
              <li class="glide__slide">
                <x-post-card title="{{ get_the_title($post->ID) }}" :thumbnail="get_the_post_thumbnail($post->ID, 'post-card')" :url="get_post_permalink($post->ID)" />
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>


  <section class="categories">
    <div class="container">
      <h2>
        Рубрики
      </h2>
    </div>

    <div class="container">
      @php
        // the query
        $categories = get_categories();
      @endphp
      <div class="row">
        @foreach ($categories as $category)
          <div class="col-sm-3">
            <a href="{{ get_category_link($category->term_id) }}">/{{ $category->name }}</a>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="donate">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2>
            Помогай
          </h2>

          <p>
            Мы работаем над проектом в свободное время и на энтузиазме. Чтобы творить, нам нужно тратить деньги на сайт,
            покупать оборудование для видео и подкастов, снимать студии. Спасибо, что присылаете нам деньги — так нам реже
            приходится тратить свои.
          </p>

          <button>Задонатить</button>
        </div>

        <div class="col-sm-6">
          <img src="https://spichka.media/wp-content/uploads/2022/01/1_1-1024x658.png" alt="">
        </div>

      </div>
    </div>

    <section class="connect">
      <div class="container">
        <h2>
          Присоеденяйся
        </h2>

        @php
          $connect_blocks = [
              [
                  'title' => 'Кружки',
                  'description' => 'В кружки вступают, чтобы изучать марксизм быстрее, легче и в коллективе единомышленников.',
              ],
              [
                  'title' => 'Медиа',
                  'description' => 'Мы рады любым талантам. Умеешь монтировать ролики, делать дизайн, писать и редактировать текст или ещё что-то? Пиши!',
              ],
              [
                  'title' => 'Онлайн-кружок',
                  'description' => 'Почти то же самое, что и обычный кружок; только занимаемся дистанционно. Подходит, если нашего кружка нет в твоём городе.',
              ],
              [
                  'title' => 'Дальше — больше...',
                  'description' => 'Не остановимся на том, что есть: уже думаем над новыми мероприятиями и активностями.',
              ],
          ];
        @endphp

        <div class="connect">
          <div data-glide-el="track" class="glide__track">
            <ul class="glide__slides">
              @foreach ($connect_blocks as $block)
                <li class="glide__slide">
                  <div>
                    <h3>{{ $block['title'] }}</h3>
                    <p>{{ $block['description'] }}</p>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      </div>
    </section>

  </section>
@endsection
