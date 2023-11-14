FROM bitnami/laravel:7

COPY composer.json /app

RUN composer install --no-interaction

FROM bitnami/laravel:7

COPY . /app

RUN php artisan key:generate

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 80

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
