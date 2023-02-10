start:
	docker compose up -d
	docker compose exec php composer install

c:
	cd client && npm install && npm run dev

migration:
	docker-compose exec php php bin/console make:migration

database:
	docker-compose exec php php bin/console d:s:u --force


stop:
	docker-compose down --remove-orphans --volumes --timeout 0

seed:
	docker-compose exec php php bin/console doctrine:fixtures:load -n

