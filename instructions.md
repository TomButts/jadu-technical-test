# Instructions

## Requirements

This project was built using the symfony-docker template. Therefore docker-compose is required to run it. Also Docker Desktop is recommended. Please find initial setup instructions in the 'Getting started' section at https://github.com/dunglas/symfony-docker or check the project README.md which has the symfony-docker docs in it.

## Setting up the project

git clone project
composer install

Basic php tests command

Export variable and symfony-docker command for setting up xdebug

PHP unit with coverage example
php bin/phpunit --exclude-group=benchmarks
php bin/phpunit --exclude-group=benchmarks --coverage-html /app/tests/Reports
