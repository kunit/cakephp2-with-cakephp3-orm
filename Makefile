.PHONY: install
install:
	docker-compose run php-cli composer install -d app
	docker-compose run php-cli chmod -R a+w ./app/tmp
	docker-compose run --rm php-cli cp -a ./cakephp3/config/.env.default ./cakephp3/config/.env

.PHONY: up
up:
	docker-compose up -d web

.PHONY: down
down:
	docker-compose down
