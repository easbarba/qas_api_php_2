.DEFAULT_GOAL := tests
.PHONY: test fmt grab archive deps lint pub img openapi
NAME := qas

server:
	php -t ./src -S localhost:${PORT}

deps:
	composer install

fmt:
	./vendor/bin/pint
	# PHP_CS_FIXER_IGNORE_ENV=true php-cs-fixer fix --diff --verbose .

lint:
	phpcbf src
	phpcs src

test:
	 ./vendor/bin/pest

grab:
	./bin/qas --grab

archive:
	./bin/qas --archive nuxt,awesomewm

pub:
	composer update
	composer validate

img:
	podman build --file ./Dockerfile --tag ${USER}/${NAME}:$(shell cat .version)

openapi:
	./vendor/bin/openapi src -o ops/openapi_$(shell cat .version).json
