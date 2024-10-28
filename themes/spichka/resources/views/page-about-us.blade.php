@extends('layouts.app')

@section('content')
  <section class="hero-section">
    <div class="container position-relative">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-sm-9 border-lg-end border-0">
          <h1 class="fw-x-bold lh-1 text-uppercase text-dark">
            Куда
            <br />
            мы идём
          </h1>

          <div class="col-12 offset-lg-4 col-md-8 description fs-6">
            <p>
              <b>Мы создали «Спичка», чтобы:</b>
            </p>

            <ol>
              <li>развивать марксизм,</li>
              <li>делать его снова популярным,</li>
              <li>сформировать сплочённый и образованный коллектив.</li>
            </ol>
          </div>
        </div>
      </div>

      <div class="image d-none d-lg-block position-absolute bottom-0 end-0">
        <img
          src="https://spichka.media/wp-content/uploads/2024/10/mask.png"
          alt="" />
      </div>
    </div>
  </section>

  <section class="about-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-md-4 border-sm-end border-0">
          <h2 class="mt-6">О чём вещаем</h2>
        </div>

        <div class="col-12 col-md-8 col-lg-5">
          <div class="description py-4 fs-6">
            <p>
              Идеи не меняют мир, если о них никто не знает.  Поэтому наш
              принцип — писать и говорить ясно.
            </p>

            <p>
              Сперва мы много писали про социалистические страны:  Восточную
              Германию, Кубу и Северную Корею.
            </p>

            <p>
              Теперь у нас больше авторов, и пишем не только про историю; ещё
              мы изучаем капитализм, вопросы эстетики и культуры, размышляем,
              что делать левым.
            </p>

            <p>
              Записываем подкасты и ведём ютуб-канал, делаем лучший дизайн среди
              левых медиа.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="program-articles-section border-top">
    <div class="container">
      <h2 class="mt-6">Программные статьи</h2>
    </div>

    <div class="mt-4 mb-8 swiper-container position-relative container-fluid">
      @php
        $program_articles = get_posts([
          'tax_query' => [
            [
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => 'programm',
            ],
          ],
          'numberposts' => -1,
        ]);
      @endphp

      <div class="swiper pb-5">
        <div class="swiper-wrapper">
          @foreach ($program_articles as $post)
            <div class="swiper-slide">
              <x-post-card :post="$post" />
            </div>
          @endforeach

          <div class="swiper-slide">
            <div class="post-card">
              @if (! empty($program_term_link) && ! is_wp_error($program_term_link))
                <a href="{!! $program_term_link !!}">
                  {!! wp_get_attachment_image(carbon_get_theme_option('posts_more_image'), 'post-card') !!}
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <section class="join-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-md-4 border-sm-end border-0">
          <h2 class="mt-6">Что ещё делаем</h2>
        </div>

        <div class="col-12 col-md-8 col-lg-5">
          <div class="description py-4 fs-6">
            <p>Мы не просто журнал. «Спичка» — это сообщество.</p>

            <p>
              У нас есть марксистские кружки в Москве, Санкт-Петербурге,
              Калининграде и Новосибирске. Для тех, кто из других городов или
              кому неудобно ходить на занятия, ведём онлайн-кружок.
            </p>

            <p>Иногда смотрим фильмы в киноклубе, ходим в музеи и походы.</p>
            <a href="#" class="btn btn-outline-dark fw-bold">
              Вступить в кружок
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="support-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-md-4 col-lg-3 border-sm-end border-0">
          <h2 class="mt-6">Нравится «Спичка»?</h2>
        </div>

        <div
          class="col-12 col-md-4 col-lg-3 align-self-center border-md-end border-0 fs-6">
          <div class="my-6">
            <h3>Помогай деньгами</h3>

            <p>
              Мы даём немного денег членам коллектива. Благодаря этому они
              меньше думают о заработке и больше — об идее.
            </p>

            <p>
              Ещё мы тратимся  на хостинг сайта, планировщик задач, рекламу,
              книги и помещения для кружков.
            </p>

            <a href="#" class="btn mt-6 btn-outline-dark fw-bold w-100">
              Задонатить
            </a>
          </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3 border-lg-end border-0 fs-6">
          <h3 class="mt-6">Вступай в коллектив</h3>

          <p>
            Прежде всего нам нужны исследователи и авторы статей, дизайнеры,
            редакторы и программисты.
          </p>

          <a href="#" class="mt-6 mb-4 btn btn-outline-dark fw-bold w-100">
            Присоединиться
          </a>
        </div>

        <div class="col-12 col-lg-3 p-lg-0 image">
          <img
            src="https://spichka.media/wp-content/uploads/2024/10/image.jpg"
            alt="" />
        </div>
      </div>
    </div>
  </section>

  <section class="footer-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="d-none d-sm-block col-3 border-sm-end border-0"></div>
        <div class="d-none d-sm-block col-3 border-sm-end border-0"></div>
        <div class="col align-self-end my-7">
          <div class="m-0 fs-5 fw-bold text-md-end">
            <span>Поддерживая нас, ты оживляешь марксизм.</span>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
