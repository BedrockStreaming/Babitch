# Babitch [![Build Status](https://secure.travis-ci.org/M6Web/Babitch.png?branch=master)](http://travis-ci.org/M6Web/Babitch)

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
Thanks to [Stage1](http://stage1.io/), you can access our master branch staging environment : http://master.m6web.babitch.stage1.io/api/doc/

Then, you have to create a client to access Babitch's API, or you can use ours : [BabitchClient](https://github.com/M6Web/BabitchClient)

## Installation for dev

#### Clone the project

```
$ git clone https://github.com/M6Web/Babitch.git
$ cd Babitch
```

Install [Vagrant](http://www.vagrantup.com/downloads) and configure `Vagrantfile` :

```
$ cp Vagrantfile.dist Vagrantfile
```

*Note : configure your own Vagrantfile if necessary.*

```
$ vagrant up
$ vagrant ssh
$ cd /vagrant
```

#### Create MySQL database

```
$ mysql -uroot -e "CREATE DATABASE babitch DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;"
```

#### Install dependencies

```
$ curl -s http://getcomposer.org/installer | php
$ php composer.phar install
```

*Note : select default values to all questions.*

#### Load fixtures

```
$  php app/console doctrine:fixture:load
```

You can now access the API doc at `http://localhost:8888/api/doc`.

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

## Docker
To use Docker as simple user (logout after this command):

    sudo usermod -aG docker $USER

Then deploy Babitch using `deploy.sh` script:

    ./docker/deploy.sh

Or manually copy sources into `docker/webapp/sources/` directory and run the command below:

    docker-compose up -d

You now have a Babitch instance listening on port `8081`, Mysql on port `3306` and PHP-FPM on port `9000`!

## Credits

Developped by the [Cytron Team](http://cytron.fr/) of [M6 Web](http://tech.m6web.fr/).

## License

Babitch is licensed under the [MIT license](LICENSE).
