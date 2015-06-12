all: init

init: install-composer depends-install install-third-party

install-composer: composer.phar

depends-install: install-composer
	php composer.phar install

depends-update: install-composer
	php composer.phar self-update
	php composer.phar update

install-third-party:
	git submodule update --init --recursive

test:
	vendor/bin/phpunit

clover.xml:
	vendor/bin/phpunit --coverage-clover=clover.xml

check-style:
	vendor/bin/phpcs --standard=PSR2 --encoding=UTF-8 src test

fix-style:
	vendor/bin/phpcbf --standard=PSR2 --encoding=UTF-8 src test

clean:
	rm -rf vendor composer.phar clover.xml

composer.phar:
	curl -sS https://getcomposer.org/installer | php

FORCE:

.PHONY: all init install-composer depends-install depends-update install-third-party test clean check-style fix-style clover.xml
