<?php

namespace Cytron\Bundle\BabitchBundle\Tests\Controller;

/**
 * Class PlayerController
 *
 * @author Morgan Brunot <mbrunot.externe@m6.fr>
 */
class PlayerController extends AbstractController
{
    public function getEntityManagerName()
    {
        return "default";
    }

    public function runTests()
    {
        $this
            ->checkBadParameters()
            ->checkAllowedMethods()
            ->checkDisabled()
            ->checkPostAndGet()
            ->checkPut()
            ->checkList()
            ->checkDelete();
    }

    public function checkBadParameters()
    {
        $this->request(['debug' => true])
            ->GET('/v1/players/1?toto')
                ->hasStatus(400)
            ->PUT('/v1/players/1?toto')
                ->hasStatus(400)
            ->DELETE('/v1/players/1?toto')
                ->hasStatus(400)
            ->GET('/v1/players?coucou')
                ->hasStatus(400)
            ->POST('/v1/players?coucou')
                ->hasStatus(400);

        return $this;
    }

    public function checkAllowedMethods()
    {
        $this->request(['debug' => true], ['HTTP_Access-Control-Request-Method'=> 'GET', 'HTTP_Origin' => 'www.m6.fr'])
            ->OPTIONS('/v1/players')
                ->hasStatus(200)
                ->hasHeader('Access-Control-Allow-Methods', 'GET, POST')
            ->OPTIONS('/v1/players/123')
                ->hasStatus(200)
                ->hasHeader('Access-Control-Allow-Methods', 'GET, PUT, DELETE');

        $this->request(['debug' => true], ['HTTP_Access-Control-Request-Method'=> 'POST', 'HTTP_Origin' => 'www.m6.fr'])
            ->OPTIONS('/v1/players')
                ->hasStatus(200)
                ->hasHeader('Access-Control-Allow-Methods', 'GET, POST')
            ->OPTIONS('/v1/players/123')
                ->hasStatus(405)
                ->hasHeader('Access-Control-Allow-Methods', 'GET, PUT, DELETE');

        return $this;
    }

    public function checkDisabled()
    {
        $this->request(['debug' => true])
            ->POST('/v1/players/1')
                ->hasStatus(405)
            ->PUT('/v1/players')
                ->hasStatus(405)
            ->DELETE('/v1/players')
                ->hasStatus(405);

        return $this;
    }

    public function checkPostAndGet()
    {
        $this->request(array('debug' => true))
            ->POST('/v1/players')
                ->hasStatus(422)

            ->POST('/v1/players', array())
                ->hasStatus(422)

            ->GET('/v1/ad/1')
                ->hasStatus(404)

            ->POST('/v1/players', array(
                    'name'  => 'John Doe',
                    'email' => 'john@doe.com',
                ))
                ->hasStatus(201)
                ->hasHeader('Location', 'http://localhost/v1/players/1')
                ->crawler
                    ->hasElement('result')
                        ->exactly(1)
                            ->hasChild('id')
                                ->withContent('1')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('name')
                                ->withContent('John Doe')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('email')
                                ->withContent('john@doe.com')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('link')
                                ->withAttribute('rel', 'self')
                                ->withAttribute('href', 'http://localhost/v1/players/1')
                                ->exactly(1)
                            ->end()
                        ->end()

            ->GET('/v1/players/1')
                ->hasStatus(200)
                ->crawler
                    ->hasElement('result')
                        ->exactly(1)
                            ->hasChild('id')
                                ->withContent('1')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('name')
                                ->withContent('John Doe')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('email')
                                ->withContent('john@doe.com')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('link')
                                ->withAttribute('rel', 'self')
                                ->withAttribute('href', 'http://localhost/v1/players/1')
                                ->exactly(1)
                            ->end()
                        ->end();

        $response = $this->GET('/v1/players/1', [], [], ['HTTP_ACCEPT' => 'application/json'])
            ->hasStatus(200)
            ->hasHeader('Content-Type', 'application/json')
            ->getValue();

        $json = json_decode($response->getContent());
        $this->object($json->_links);

        return $this;
    }

    public function checkPut()
    {
        $this->request(array('debug' => true))
            ->PUT('/v1/players/1')
                ->hasStatus(422)

            ->PUT('/v1/players/1', array(
                    'name' => 'John Douglas',
                    'email'=> 'john@douglas.com',
                ))
                ->hasStatus(204)

            ->GET('/v1/players/1')
                ->hasStatus(200)
                ->crawler
                    ->hasElement('result')
                        ->exactly(1)
                            ->hasChild('id')
                                ->withContent('1')
                                ->hasNoChild()
                            ->end()
                            ->hasChild('name')
                                ->withContent('John Douglas')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('email')
                                ->withContent('john@douglas.com')
                                ->exactly(1)
                                ->hasNoChild()
                            ->end()
                            ->hasChild('link')
                                ->withAttribute('rel', 'self')
                                ->withAttribute('href', 'http://localhost/v1/players/1')
                                ->exactly(1)
                            ->end()
                        ->end();

        return $this;
    }

    public function checkList()
    {
        $this->request(array('debug' => true))
            ->POST('/v1/players', array(
                    'name'  => 'Peter Smith',
                    'email' => 'peter@smith.com',
                ))
                ->hasStatus(201)
                ->hasHeader('Location', 'http://localhost/v1/players/2')

            ->GET('/v1/players?page=1&per_page=1')
                ->hasStatus(200)
                ->crawler
                    ->hasElement('result')
                        ->hasChildExactly(1)
                        ->hasChild('entry')
                            ->hasChild('link')
                                ->withAttribute('rel', 'self')
                                ->withAttribute('href', 'http://localhost/v1/players/2')
                                ->exactly(1)
                            ->end()
                        ->end()
                    ->end()

            ->GET('/v1/players?page=2&per_page=1')
                ->hasStatus(200)
                ->crawler
                    ->hasElement('result')
                        ->hasChildExactly(1)
                        ->hasChild('entry')
                            ->hasChild('link')
                                ->withAttribute('rel', 'self')
                                ->withAttribute('href', 'http://localhost/v1/players/1')
                                ->exactly(1)
                            ->end()
                        ->end()
                    ->end();

        return $this;
    }

    public function checkDelete()
    {
        $this->request(array('debug' => true))
            ->GET('/v1/players/1')
                ->hasStatus(200)

            ->DELETE('/v1/players/1')
                ->hasStatus(204)

            ->GET('/v1/players/1')
                ->hasStatus(404)

            ->DELETE('/v1/players/1')
                ->hasStatus(404);

        return $this;
    }
}
