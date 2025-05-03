# Сайт

## Для ознакомления

- [Документация Wordpress](https://wordpress.org/documentation/)
- [Документация Sage](https://roots.io/sage/docs/)
- [Bootstrap 5](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [Что нового в PHP8.3](https://www.php.net/releases/8.3/ru.php) 
- [Введение в Composer](https://getcomposer.ucoz.org/publ/kniga/osnovnoe_ispolzovanie/2-1-0-2)
- [Настройка PHP_CodeSniffer от JetBrains](https://www.jetbrains.com/help/phpstorm/using-php-code-sniffer.html)
- [Настройка ESLint](https://www.jetbrains.com/help/phpstorm/eslint.html)
- [Настройка Stylelint](https://www.jetbrains.com/help/phpstorm/using-stylelint-code-quality-tool.html)
- [Документация Bud.js](https://bud.js.org/learn/config/dev-server)
- [Документация Yarn](https://yarnpkg.com/getting-started)

## Требуется для работы
- Docker

## Инструкция по разворачиванию локального окружения в первый раз (без доступов)

- Выполни `docker compose up -d --build`.
- По адресу http://localhost:8000 выполни установку WordPress
- Установи и активируй все рекомендуемые плагины _по очереди_ в админке _Appearance -> Install Plugins_.
- Активируй тему _Spichka Starter Theme_ в _Appearance -> Themes_.

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
- В wp-admin установи и активируй все рекомендуемые плагины _по очереди_ в админке Appearance -> Install Plugins (если их не было в бэкапе).

## Инструкция по запуску локального окружения

- Запусти контейнеры `docker compose up -d --build`
- Переходи на `http://localhost:8000`
