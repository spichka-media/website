# Сайт

## Требуется для работы

- Docker
- Node, v16
- yarn, v1.22

## Инструкция по разворачиванию локального окружения в первый раз

- Скачай бэкап, используя Duplicator Pro
- Положи бэкап в папку `backup`
- В `docker-compose.yaml` для сервиса `wordpress` добавь volume'ы с бэкапом по примеру, закоментируй остальные volume'ы
- Выполни `docker-compose up -d --build`
- Выполни `docker exec -it spichka_website sh -c "chown www-data:www-data /var/www/html/installer.php"`
- Выполни `docker exec -it spichka_website sh -c "chown www-data:www-data /var/www/html/[название архива.zip]"`
- Перейди на `localhost:8000/installer.php`
- Для подключения к базе данных в инсталлере используй адрес сервиса `db` и внутренний порт (spichka_website_db:3306)
- Задокументируй обратно `backup` в `docker-compose.yaml` и раскоментируй файлы темы
- Выполни `docker exec -it spichka_website sh -c "cd /var/www/html/wp-content/themes/spichka && composer install"`
- Перейди в папку с темой `themes/spichka`
- Выполни `yarn`

## Инструкция по запуску локального окружения

- Запусти контейнеры `docker-compose up -d --build`
- Выполни `yarn dev` в папке с темой `themes/spichka`
- Переходи на `localhost:8001`
