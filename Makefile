.PHONY: all
all: install-third-party test

.PHONY: install-third-party
install-third-party:
	git submodule update --init --recursive

.PHONY: test
test: vendor check-style
	vendor/bin/phpunit

.PHONY: check-style
check-style: check-style-syntax check-style-phpcs check-style-phpstan

.PHONY: check-style-syntax
check-style-syntax:
	find . \( -type d \( -name '.git' -or -name 'vendor' -or -name 'runtime' \) -prune \) -or \( -type f -name '*.php' -print \) | xargs -n 1 php -l

.PHONY: check-style-phpcs
check-style-phpcs: vendor
	vendor/bin/phpcs --standard=PSR12 --encoding=UTF-8 src test

.PHONY: check-style-phpstan
check-style-phpstan: vendor
	vendor/bin/phpstan analyze --level=8 src test

.PHONY: fix-style
fix-style: vendor
	vendor/bin/phpcbf --standard=PSR12 --encoding=UTF-8 src test

.PHONY: clean
clean:
	rm -rf vendor composer.phar

composer.lock: composer.json composer.phar
	./composer.phar install -v
	touch $@

vendor: composer.lock composer.phar
	./composer.phar update -v	
	touch $@

composer.phar:
	curl -sS https://getcomposer.org/installer | php
	touch -r composer.json $@
