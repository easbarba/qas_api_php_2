FROM composer:lts as builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install

FROM php:8-alpine
MAINTAINER EAS Barbosa <easbarba@outlook.com>
WORKDIR /app
COPY --from=builder /app/vendor /app/vendor
COPY . .
COPY ./docs/examples /root/.config/qas
RUN apk add --update git
CMD ["./vendor/bin/phpunit"]
