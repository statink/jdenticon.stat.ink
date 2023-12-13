.PHONY: all
all: vendor

.PHONY: clean
clean:
	rm -rf vendor composer.phar

.PHONY: check-style
check-style: check-style-phpcs check-style-phpstan

.PHONY: check-style-phpcs
check-style-phpcs: vendor
	./vendor/bin/phpcs

.PHONY: check-style-phpstan
check-style-phpstan: vendor
	./vendor/bin/phpstan analyse

vendor: composer.lock composer.phar
	./composer.phar install --prefer-dist
	@touch $@

composer.phar:
ifeq (, $(shell which composer 2>/dev/null))
	curl -fsSL 'https://getcomposer.org/installer' | php -- --filename=$@ --stable
else
	ln -s `which composer` $@
endif
