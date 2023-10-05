# HIRINGME
## Installation
## Tests
```sh
 php bin/phpunit
```
## Tools
### php-cs-fixer
Currently, using default configuration
```sh
 ./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src/
```
### phpstan
Error level [0..9] (default = 0), currently using level max (9)
```sh
 ./tools/phpstan/vendor/bin/phpstan analyse src --level=max
```
