.PHONY: all
all: install-third-party test

.PHONY: install-third-party
install-third-party:
	git submodule update --init --recursive

.PHONY: test
test: vendor check-style
	php -d zend.assertions=1 vendor/bin/phpunit

.PHONY: check-style
check-style: check-style-syntax check-style-phpcs check-style-phpstan

# PHP 8.3 以降は `php -l` が複数ファイルを受け付けるので、
# 1ファイルごとにプロセスを起動しなくて済む。
# 8.2 以前に複数渡すと先頭のファイルしか検査されず素通りするため、
# バージョンを見て xargs の渡し方を変える。
# https://github.com/php/php-src/blob/PHP-8.3/UPGRADING (CLI の項)
.PHONY: check-style-syntax
check-style-syntax:
	if php -r 'exit(PHP_VERSION_ID >= 80300 ? 0 : 1);'; then \
		xargs_opts=''; \
	else \
		xargs_opts='-n 1'; \
	fi; \
	find . \( -type d \( -name '.git' -or -name 'vendor' -or -name 'runtime' \) -prune \) -or \( -type f -name '*.php' -print \) \
		| xargs $$xargs_opts php -l

.PHONY: check-style-phpcs
check-style-phpcs: vendor
	vendor/bin/phpcs --standard=PSR12 --encoding=UTF-8 src test

.PHONY: check-style-phpstan
check-style-phpstan: vendor
	vendor/bin/phpstan analyze

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
