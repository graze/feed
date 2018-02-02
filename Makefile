.DEFAULT_GOAL:= help
.PHONY: test
.PHONY: lint lint-fix

# Setting up

setup: ## Install dependencies and set up example conf file
	@docker-compose run --rm composer update

# Testing

test: ## Run the lint unit tests.
test: lint test-unit

lint: ## Run phpcs against the code.
	@docker-compose run --rm php-55 vendor/bin/phpcs -p --warning-severity=0 src/

lint-fix: ## Run phpcbf against the code.
	@docker-compose run --rm php-55 vendor/bin/phpcbf -p src/

test-unit: ## Run the unit tests.
	@docker-compose run --rm php-55 vendor/bin/phpunit

.SILENT: help
help: ## Show this help message
	set -x
	echo "Usage: make [target] ..."
	echo ""
	echo "Available targets:"
	egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'
