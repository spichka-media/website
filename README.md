# Сайт

## Для ознакомления

- [Bootstrap 5](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [Документация Wordpress](https://wordpress.org/documentation/)
- [Шпаргалка по Wordpress](https://wp-kama.ru/handbook/cheatsheet)
- [Документация Carbon Fields](https://docs.carbonfields.net/)
- [Документация Sage](https://roots.io/sage/docs/)

## Требуется для работы

- `docker`
- `node`
- `yarn`
- `wsl` - на случай **если работаешь на _Windows_**, используй _Linux_ или другое _Unix-подобное_ окружение

## Инструкция по разворачиванию локального окружения в первый раз (без доступов)

- Выполни по очереди команды:
```sh
# подними контейнеры
docker compose up -d --build
# запусти composer в контейнере
docker exec -it spichka_website sh -c "cd /var/www/html/wp-content/themes/spichka && composer install"
# перейди в папку с темой
cd themes/spichka
# установи зависимости для Sage
yarn install
# запусти локальный сервер для разработки
yarn dev
```
- Для установки темы, в wp-admin предварительно установи все необходимые и рекомендуемые плагины _по очереди_ в админке Appearance -> Install Plugins

## Инструкция по разворачиванию локального окружения в первый раз (если у тебя есть доступ к сайту)

- Скачай бэкап, используя Duplicator.
- Положи бэкап в папку `backup`.
- В `docker compose.yaml` для сервиса `wordpress` добавь volume'ы с бэкапом по примеру, закоментируй остальные volume'ы, кроме uploads (!).
- Выполни `docker compose up -d --build`.
- Выполни `docker exec -it spichka_website sh -c "chown www-data:www-data /var/www/html/installer.php"`.
- Выполни `docker exec -it spichka_website sh -c "chown www-data:www-data /var/www/html/[название архива.zip]"`.
- Перейди на `localhost:8000/installer.php`.
- Для подключения к базе данных в инсталлере используй адрес сервиса `db` (spichka_website_db:3306).
- Задокументируй обратно `backup` в `docker compose.yaml` и раскоментируй файлы темы.
- Выполни `docker exec -it spichka_website sh -c "cd /var/www/html/wp-content/themes/spichka && composer install"`.
- Перейди в папку с темой `themes/spichka`.
- Выполни `yarn`.
- В wp-admin установи и активируй все рекомендуемые плагины _по очереди_ в админке Appearance -> Install Plugins (если их не было в бэкапе).

## Инструкция по запуску локального окружения

- Запусти контейнеры `docker compose up -d --build`
- Выполни `yarn dev` в папке с темой `themes/spichka`
- Переходи на `localhost:8001`
