#!make
include .env

# ejecutar docker-compose para crear el contenedor
.PHONY: compose
compose: CMD=up -d --build

.PHONY: compose_start
compose_start compose:
	docker-compose $(CMD)

# instalar vendors
.PHONY: install_composer
install_composer: CMD=--ignore-platform-reqs

.PHONY: vendors
vendors install_composer:
	composer install $(CMD)

# ejecutar test de phpunit
.PHONY: run-tests
run-tests:
	@docker exec ${APP_NAME} vendor/bin/phpunit --coverage-html var/coverage

# analizar formato php PSR12
.PHONY: check-style
check-style:
	@docker exec ${APP_NAME} vendor/bin/phpcs --standard=PSR12 src tests --runtime-set ignore_errors_on_exit 1 --runtime-set ignore_warnings_on_exit 1

# corregir PSR12
.PHONY: fix-style
fix-style:
	@docker exec ${APP_NAME} vendor/bin/phpcbf --standard=PSR12 src tests

# crear informe de metricas php
.PHONY: metrics
	@docker exec ${APP_NAME} vendor/bin/phpmetrics src --report-html=var/metrics

# revert last changes in repository
.PHONY: revert
revert:
	@git reset --hard
