# PHPUnit workshop

```
docker run --rm -it --volume $PWD:/app composer create-project symfony/skeleton app
docker run --rm -it --volume $PWD/app:/app composer require --dev symfony/phpunit-bridge
docker run --rm -it --volume $PWD/app:/app composer require symfony/orm-pack
docker run --rm -it --volume $PWD/app:/app composer require --dev symfony/maker-bundle
docker run --rm -it --volume $PWD/app:/app composer bin/phpunit

```