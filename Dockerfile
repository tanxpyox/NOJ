FROM redis:5.0 as redis
FROM php:apache
FROM composer
FROM mySQL:8
RUN compose install
RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan migrate
RUN crontab -e * * * * * php /path-to-noj/artisan schedule:run
