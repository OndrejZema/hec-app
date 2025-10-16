# Spuštění kontejnerů
up:
	docker compose up -d

# Zastavení kontejnerů
down:
	docker compose down

# Shell do PHP kontejneru
bash:
	docker compose exec php bash

# Instalace Symfony skeleton + balíčky pro vývoj
init:
	docker compose exec php bash -c "\
		composer create-project symfony/skeleton . && \
		composer require symfony/twig-pack symfony/asset-mapper symfony/security-bundle symfony/validator symfony/form symfony/mailer symfony/twig-bundle symfony/runtime orm && \
		composer require symfonycasts/verify-email-bundle symfonycasts/reset-password-bundle symfony/ux-twig-component symfony/ux-live-component symfony/ux-translator  && \
		composer require symfony/maker-bundle --dev && \
		composer require symfony/stimulus-bundle && \ 
		composer require symfony/ux-turbo && \
		composer require symfonycasts/tailwind-bundle && \
		composer require symfony/asset && \
		bin/console importmap:install \
	"
tw-init:
	docker compose exec php bash -c "php bin/console tailwind:init"

tw-watch:
	docker compose exec php bash -c "php bin/console tailwind:build --watch"
tw-build:
	docker compose exec php bash -c "php bin/console tailwind:build"

# Instalace závislostí (pokud už projekt existuje)
install:
	docker compose exec php composer install

# Vygenerování loginu a registrace
auth:
	docker compose exec php bash -c "\
		bin/console make:user && \
		bin/console make:security:form-login && \
		bin/console make:registration-form && \
		bin/console make:reset-password && \
		php bin/console make:migration \
	"
make-migration:
	docker compose exec php bash -c "php bin/console make:migration"
migrate:
	docker compose exec php bash -c "php bin/console doctrine:migrations:migrate"
