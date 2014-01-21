<?php

namespace Cytron\Bundle\BabitchBundle\Tests\Controller;

use atoum\AtoumBundle\Test\Controller\ControllerTest as BaseControllerTest;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Test controller
 *
 * @author Morgan Brunot <mbrunot.externe@m6.fr>
 */
abstract class AbstractController extends BaseControllerTest
{
    protected $application;

    /**
     * Get current entity manager name.
     *
     * @return string
     */
    abstract protected function getEntityManagerName();

    /**
     * Execute tests.
     *
     * @return void
     */
    abstract protected function runTests();

    /**
     * Get console application.
     *
     * @return Symfony\Bundle\FrameworkBundle\Console\Application
     */
    protected function getApplication()
    {
        if (null === $this->application) {
            $client = $this->createClient();

            $this->application = new Application($client->getKernel());
            $this->application->setAutoExit(false);
        }

        return $this->application;
    }

    /**
     * Run command.
     *
     * @param array $arguments
     *
     * @return void
     */
    protected function runCommand($arguments = array())
    {
        $input = new ArrayInput($arguments);

        $this->getApplication()->run($input, new NullOutput());
    }

    /**
     * Create database.
     *
     * @return void
     */
    protected function createDatabase()
    {
        $this->runCommand(array(
            'command' => 'doctrine:schema:create',
            '--env'   => 'test',
            '--em'    => $this->getEntityManagerName(),
        ));
    }

    /**
     * Drop database.
     *
     * @return void
     */
    protected function deleteDatabase()
    {
        $this->runCommand(array(
            'command' => 'doctrine:schema:drop',
            '--env'   => 'test',
            '--em'    => $this->getEntityManagerName(),
            '--force' => true,
        ));
    }

    /**
     * Method call by atoum for run tests.
     *
     * @return void
     */
    public function testController()
    {
        $this->deleteDatabase();
        $this->createDatabase();

        $this->runTests();
    }
}
