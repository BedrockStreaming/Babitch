# Babitch

Many companies all over the world uses table soccer to build team spirit. Babitch is a project to **record** table soccer scores, **archive** them, and **make them easily accessible for** further analysis using a REST API.

## Installation

#### Clone the project

```
$ git clone https://github.com/M6Web/Babitch.git
$ cd Babitch
```

#### Install dependencies

```
$ curl -s http://getcomposer.org/installer | php
$ php composer.phar install
```

#### Configure database connection

```
$ cp app/config/parameters.yml.dist app/config/parameters.yml
```

Edit this new file to setup your MySQL connection.

## Use

The API documentation is available at `http://babitch-server/api/doc/`  
You have to create a client to access Babitch's API, or you can use ours : [BabitchClient](https://github.com/M6Web/BabitchClient)

## Tests

Create test database

```shell
php app/console doctrine:database:create --env=test
php app/console doctrine:schema:create --env=test
```
Run tests

```shell
php bin/behat
```

## Credits

Developped by the [Cytron Team](http://cytron.fr/) of [M6 Web](http://tech.m6web.fr/).

## License

Babitch is licensed under the [MIT license](LICENSE).
