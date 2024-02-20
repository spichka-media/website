# Сайт

## Требуется для работы

- Docker
- Node
- yarn

## Инструкция по разворачиванию локального окружения в первый раз

- Положи бэкап `backup` папку
- Раскоментируй backup файлы в `docker-compose.yaml` и переименуй там архив
- Выполни `docker-compose up -d --build`
- Перейди на `localhost:8000/installer.php`
- Для подключения к базе данных используй адрес `db:3306`
- Выполни `docker exec -it spichka_website sh -c "cd /var/www/html/wp-content/themes/spichka && composer install"`
- Перейди в папку с темой
- Выполни `yarn`

## Инструкция по запуску локального окружения

- Не забудь запустить контейнера ( `docker-compose up -d --build`)
- Выполни `yarn dev` в папке с темой `themes/spichka`
- Переходи на `localhost:8001`
