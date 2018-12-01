.PHONY: install
install:
	docker-compose run --rm php-cli composer install -d app
	docker-compose run --rm php-cli chmod -R a+w ./app/tmp

.PHONY: up
up:
	docker-compose up -d web

.PHONY: down
down:
	docker-compose down
