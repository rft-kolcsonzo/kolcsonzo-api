FROM webdevops/php-nginx:7.2

ARG VCS_REF=HEAD

LABEL   org.label-schema.vcs-ref=${VCS_REF} \
        org.label-schema.vcs-url="https://github.com/rft-kolcsonzo/kolcsonzo-api"

COPY --chown=application:application . /app

ENV RUNTIME=docker \
    PHP_DATE_TIMEZONE=Europe/Budapest

EXPOSE 80 443