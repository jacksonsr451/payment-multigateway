COMPOSE = docker compose

.PHONY: up down seed test swagger fix

up:
	$(COMPOSE) up -d --build

down:
	$(COMPOSE) down

seed:
	$(COMPOSE) exec app php artisan db:seed

test:
	$(COMPOSE) exec app php artisan test

swagger:
	$(COMPOSE) exec app php artisan l5-swagger:generate

fix:
	$(COMPOSE) exec app ./vendor/bin/pint
