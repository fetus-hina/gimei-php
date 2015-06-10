all: init

init: install-composer depends-install install-third-party data/names.yml data/addresses.yml

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
	# vendor/bin/phpmd src text codesize,design,naming,unusedcode
	vendor/bin/phpcs --standard=PSR2 src test

fix-style:
	vendor/bin/phpcbf --standard=PSR2 src test

clean:
	rm -rf vendor composer.phar clover.xml

composer.phar:
	curl -sS https://getcomposer.org/installer | php

data/names.yml: install-third-party
	cp third-party/gimei-original/lib/data/names.yml data/names.yml

data/addresses.yml: install-third-party
	cp third-party/gimei-original/lib/data/addresses.yml data/addresses.yml

FORCE:

.PHONY: all init install-composer depends-install depends-update install-third-party test clean check-style fix-style clover.xml
