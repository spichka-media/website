# Сайт

## Требуется для работы

- Docker
- Node
- yarn

## Инструкция по запуску локального окружения

- Положи бэкап в корень сайта
- Для подключения к базе данных используй адрес `db:3306`
- Выполни `docker-compose up -d --build`
- Перейди в папку с темой
- Выполни `docker exec -it spichka_website sh -c "cd /var/www/html/wp-content/themes/spichka && composer install"`
- Выполни `yarn`
- Выполни `yarn dev`
- Переходи на `localhost:8001`
