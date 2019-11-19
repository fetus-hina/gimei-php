.PHONY: all
all: install-third-party test

install-third-party:
	git submodule update --init --recursive

test: vendor check-style
	vendor/bin/phpunit

check-style: vendor
	find . \( -type d \( -name '.git' -or -name 'vendor' -or -name 'runtime' \) -prune \) -or \( -type f -name '*.php' -print \) | xargs -n 1 php -l
	vendor/bin/phpcs --standard=PSR12 --encoding=UTF-8 src test

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
