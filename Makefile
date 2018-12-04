.PHONY: install
install:
	docker-compose run --rm php-cli composer install -d app
	docker-compose run --rm php-cli install -d -m 0777 ./app/tmp
	docker-compose run --rm php-cli cp -a ./cakephp3/config/.env.default ./cakephp3/config/.env
	docker-compose run --rm php-cli cp -a ./cakephp3/config/app.default.php ./cakephp3/config/app.php

.PHONY: up
up:
	docker-compose up -d web

.PHONY: down
down:
	docker-compose down
