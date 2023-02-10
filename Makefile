.DEFAULT_GOAL := tests
.PHONY: tests fmt grab archive deps lint pub
NAME := qas

server:
	php -t ./src -S localhost:${PORT}

deps:
	composer install

fmt:
	PHP_CS_FIXER_IGNORE_ENV=true php-cs-fixer fix --diff --verbose .

lint:
	phpcbf src
	phpcs src

tests:
	 ./vendor/bin/phpunit

grab:
	./bin/qas --grab

archive:
	./bin/qas --archive nuxt,awesomewm

pub:
	composer update
	composer validate

img:
	podman build --file ./Dockerfile --tag ${USER}/${NAME}:$(shell cat .version)
