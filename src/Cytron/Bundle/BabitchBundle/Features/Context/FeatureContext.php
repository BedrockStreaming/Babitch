<?php

namespace Cytron\Bundle\BabitchBundle\Features\Context;

use Behat\Behat\Context\BehatContext;
use Sanpi\Behatch\Context\BehatchContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Event\ScenarioEvent;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Cytron\Bundle\BabitchBundle\Entity\Player;

/**
* FeatureContext
*/
class FeatureContext extends BehatContext implements KernelAwareInterface
{

    /**
     * Symfony2 kernel
     * @var KernelInterface
     */
    protected $kernel;

    /**
    * @{inheritdoc}
    */
    public function __construct(array $parameters)
    {
        $this->useContext('mink', new MinkContext($parameters));
        $this->useContext('behatch', new BehatchContext($parameters));
    }

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel HttpKernel instance
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @param SuiteEvent $event Event
     *
     * @BeforeScenario
     */
    public static function prepare(ScenarioEvent $event)
    {
        exec('php app/console doctrine:schema:drop --env=test --force');
        exec('php app/console doctrine:schema:create --env=test');
    }

    /**
     * @Given /^I have players:$/
     */
    public function iHavePlayers(TableNode $table)
    {
        $playerManager = $this->kernel->getContainer()->get('cytron_babitch.player.manager');

        foreach ($table->getRows() as $row) {
            $player = new Player();
            $player->setName($row[0]);
            $player->setEmail($row[1]);
            $playerManager->persist($player, true);
        }
    }

}
