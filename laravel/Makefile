MAKEFLAGS += -j3
.PHONY: install

install:
	composer install
	npm install
	php artisan key:generate
	php artisan migrate

php-serve:
	php artisan serve
npm-watch:
	npm run watch
mongod:
	sudo mongod --port=27018

serve:php-serve npm-watch mongod
