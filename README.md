# Сайт

## Требуется для работы

- Docker
- Node, >=18
- yarn, v1.22

## Инструкция по разворачиванию локального окружения в первый раз

- Скачай бэкап, используя Duplicator Pro.
- Положи бэкап в папку `backup`.
- В `docker-compose.yaml` для сервиса `wordpress` добавь volume'ы с бэкапом по примеру, закоментируй остальные volume'ы, кроме uploads (!).
- Выполни `docker-compose up -d --build`.
- Выполни `docker exec -it spichka_website sh -c "chown www-data:www-data /var/www/html/installer.php"`.
- Выполни `docker exec -it spichka_website sh -c "chown www-data:www-data /var/www/html/[название архива.zip]"`.
- Перейди на `localhost:8000/installer.php`.
- Для подключения к базе данных в инсталлере используй адрес сервиса `db` (spichka_website_db:3306).
- Задокументируй обратно `backup` в `docker-compose.yaml` и раскоментируй файлы темы.
- Выполни `docker exec -it spichka_website sh -c "cd /var/www/html/wp-content/themes/spichka && composer install"`.
- Перейди в папку с темой `themes/spichka`.
- Выполни `yarn`.
- В wp-admin установи и активируй все рекомендуемые плагины _по очереди_ в админке Appearance -> Install Plugins (если их не было в бэкапе).

## Инструкция по запуску локального окружения

- Запусти контейнеры `docker-compose up -d --build`
- Выполни `yarn dev` в папке с темой `themes/spichka`
- Переходи на `localhost:8001`
