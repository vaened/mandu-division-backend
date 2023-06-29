current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.PHONY: build
build: deps start

.PHONY: deps
deps: composer-install

.PHONY: app
app:
	docker-compose exec mandu_backend_php bash

art:
	docker-compose exec mandu_backend_php php artisan $(filter-out $@,$(MAKECMDGOALS))

composer-env-file:
	@if [ ! -f .env ]; then echo '' > .env; fi

.PHONY: composer-install
composer-install: CMD=install

.PHONY: composer-update
composer-update: CMD=update

.PHONY: composer-require
composer-require: CMD=require
composer-require: INTERACTIVE=-ti --interactive

.PHONY: composer-require-module
composer-require-module: CMD=require $(module)
composer-require-module: INTERACTIVE=-ti --interactive

.PHONY: composer
composer composer-install composer-update composer-require composer-require-module: composer-env-file
	@docker run  --rm $(INTERACTIVE) --volume $(current-dir):/app --user $(id -u):$(id -g) \
		composer:2.5 $(CMD) \
			--ignore-platform-reqs \
			--no-ansi

.PHONY: reload
reload: composer-env-file
	@docker-compose exec php-fpm kill -USR2 1
	@docker-compose exec nginx nginx -s reload

.PHONY: test
test: composer-env-file
	docker exec mandu_division_backend-php php artisan test

.PHONY: start
start: CMD=up --build -d

.PHONY: stop
stop: CMD=stop

.PHONY: destroy
destroy: CMD=down

.PHONY: doco
doco start stop destroy: composer-env-file
	UID=${shell id -u} GID=${shell id -g} docker-compose $(CMD)

.PHONY: rebuild
rebuild: composer-env-file
	docker-compose build --pull --force-rm --no-cache
	make deps
	make start

clean-cache:
	@docker exec mandu_division_backend-php php artisan cache:clear
	@docker exec mandu_division_backend-php php artisan route:clear
	@docker exec mandu_division_backend-php php artisan view:clear
