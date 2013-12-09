# Babitch

Many companies all over the world uses babyfoot to build team spirit. Babitch is a project to **record** babyfoot scores, **archive** them, and **make them easily accessible for** further analysis.

Babitch provides a simple responsive user interface to record scores, store them in a simple MySQL database and make them easily accessible by a REST API.


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

* User interface to record scores : `http://babitch-server/app/index.html`,
* REST API : `http://babitch-server/api/doc/`

*Note : don't forget to add users with the API.*

## Credits

Developped by the [Cytron Team](http://cytron.fr/) of [M6 Web](http://tech.m6web.fr/).  

## License

Babitch is licensed under the [MIT license](LICENSE).
