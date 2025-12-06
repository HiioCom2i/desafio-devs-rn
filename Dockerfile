FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# habilita módulo rewrite
RUN a2enmod rewrite