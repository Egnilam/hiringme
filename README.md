# WISHLIST
## Installation
## Tests
```sh
 php bin/phpunit domain
```
## Tools
### php-cs-fixer
Currently, using default configuration
```sh
 ./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src/
 ./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix domain/
```
### phpstan
Error level [0..9] (default = 0), currently using level max (9)
```sh
 ./tools/phpstan/vendor/bin/phpstan analyse src --level=max
 ./tools/phpstan/vendor/bin/phpstan analyse domain --level=max
```
