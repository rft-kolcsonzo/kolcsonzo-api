# CarRental REST API
[![CircleCI](https://circleci.com/gh/rft-kolcsonzo/kolcsonzo-api.svg?style=shield)](https://circleci.com/gh/rft-kolcsonzo/kolcsonzo-api)
[![Latest pre-release](https://img.shields.io/github/tag/rft-kolcsonzo/kolcsonzo-api.svg)](https://github.com/rft-kolcsonzo/kolcsonzo-api)
[![Docker image size](https://img.shields.io/microbadger/image-size/clearcodesolutions/kolcsonzo-api.svg)](https://hub.docker.com/r/clearcodesolutions/kolcsonzo-api/)

REST API of a simple car rental software made for a university project. 

## Requirements
- PHP >=5.6
- composer

## Installation
Simply clone the project and install dependencies via

```terminal
$ composer install
```

Host it via nginx/apache and rewrite every request to index.php (default .htaccess can be found in root)

## Docker
Automated Docker image build is initiated on every push and result images of tags/master/develop are distributed to [clearcodesolutions/kolcsonzo-api](https://hub.docker.com/r/clearcodesolutions/kolcsonzo-api/) repository on Docker Hub.

### Base image
The base image used by this project is [webdevops/php-nginx](https://hub.docker.com/r/webdevops/php-nginx/).

### How to start?
```terminal
$ docker run -p8080:80 clearcodesolutions/kolcsonzo-api
```

By default the nginx listens on port number **80** for HTTP requests.

### Configuration
Configuration is possible via environment variables:

Environment variable | Example | Description
--- | --- | ---
DB_HOST | my-mysql | Hostname of the mysql database
DB_NAME | car_rental | Name of the database to be used
DB_USER | car_rental | Username to access the database
DB_PASSWORD | supersecret | Password to access the database

## Endpoints
You can find example request/response bodies for every endpoint:
- [/users](docs/users.md)
- [/cars](docs/cars.md)
- [/images](docs/images.md)
- [/services](docs/services.md)
- [/auth](docs/auth.md)

## Purpose
Our task was to create a working software in a team. We had to separate the whole project into two pieces: API and front-end UI. You can find the front-end UI here: [rft-kolcsonzo/kolcsonzo-ui](https://github.com/rft-kolcsonzo/kolcsonzo-ui)