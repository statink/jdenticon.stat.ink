.PHONY: all
all: vendor config/components/web/request/cookie-validation-key.txt

.PHONY: clean
clean:
	rm -rf vendor composer.phar

vendor: composer.lock composer.phar
	./composer.phar install --prefer-dist
	@touch $@

composer.phar:
ifeq (, $(shell which composer 2>/dev/null))
	curl -fsSL 'https://getcomposer.org/installer' | php -- --filename=$@ --stable
else
	ln -s `which composer` $@
endif

config/components/web/request/cookie-validation-key.txt:
	openssl rand -base64 32 > $@
