<?php

namespace Cytron\Bundle\BabitchBundle\Features\Context;

use Behat\Behat\Context\BehatContext;
use Sanpi\Behatch\Context\BehatchContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\NullOutput;

/**
* FeatureContext
*/
class FeatureContext extends BehatContext implements KernelAwareInterface
{
    /**
     * symfony Kernel
     */
    protected $kernel;

    /**
     * symfony Application
     */
    protected $application;

    /**
    * @{inheritdoc}
    */
    public function __construct(array $parameters)
    {
        $this->useContext('mink', new MinkContext($parameters));
        $this->useContext('behatch', new BehatchContext($parameters));
    }

    /** @BeforeScenario */
    public function before($event)
    {
        $this->runCommand(array(
            'command' => 'doctrine:schema:drop',
            '--env'   => 'test',
            '--force' =>  true
        ));
        $this->runCommand(array(
            'command' => 'doctrine:schema:create',
            '--env'   => 'test'
        ));
    }

    /**
     * Get symfony2 application
     *
     * @return Application
     */
    protected function getApplication()
    {
        if (!$this->application) {
            $this->application = new Application($this->kernel);
            $this->application->setAutoExit(false);
        }

        return $this->application;
    }

    /**
     * Run symfony2 command
     *
     * @param array $arguments command arguments
     */
    protected function runCommand(array $arguments)
    {
        $application = $this->getApplication();

        $input = new ArrayInput($arguments);

        $application->run($input, new NullOutput());
    }

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
}
