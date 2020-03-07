#!/usr/bin/make -f

COMPOSER_BIN := composer

build: vendor
	vendor/bin/phpunit
.PHONY: build

vendor: composer.json
	$(COMPOSER_BIN) install
