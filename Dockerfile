FROM webdevops/php-nginx:7.2

COPY --chown=application:application . /app

ENV RUNTIME=docker \
    PHP_DATE_TIMEZONE=Europe/Budapest

EXPOSE 80 443