# Project

You can run project via docker-compose (docker and docker-compose need to be [installed](https://docs.docker.com/get-docker)):
```
docker-compose build
docker-compose up -d

```

Make sure you have files for logging [access.log](logs%2Fnginx%2Faccess.log) [error.log](logs%2Fnginx%2Ferror.log)
If no, create them.


Go to php container and install all dependencies:
```
docker exec -it php_container sh
composer install
```

Also, you need to build scripts 
```
yarn install
```

and run them

```
yarn build
```

to run tests, you can do it inside php docker container

```
php bin/phpunit
```

To see the application, go to http://127.0.0.1:8080/text page

Also, you'll need to have api keys for get data and for mailing:
RAPID_API and MAILER_DSN