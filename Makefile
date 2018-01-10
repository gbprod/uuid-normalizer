.PHONY: install test-unit test-coverage

PHP?=php
COMPOSER?=composer

install: vendor

test-unit: install
	$(PHP) vendor/bin/phpunit

test-coverage: install
	$(PHP) vendor/bin/phpunit --coverage-text

vendor: composer.lock
	$(COMPOSER) install

composer.lock: composer.json
	$(COMPOSER) update
