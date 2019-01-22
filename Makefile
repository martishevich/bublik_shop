docker-build:
	docker-compose up --build

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-login:
	docker exec -it bublik-php /bin/bash

docker-prune:
	docker system prune -a

composer-update:
	php composer.phar update

test:
	./vendor/bin/phpunit
