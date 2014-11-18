<?php

namespace Cytron\Bundle\BabitchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cytron\Bundle\BabitchBundle\Entity\Player;

class LoadPlayerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $playersData = array(
            ['name' => 'Johnsie', 'email' => 'johnsie@gmail.com'],
            ['name' => 'Alishia', 'email' => 'alishia@gmail.com'],
            ['name' => 'Ivan', 'email' => 'ivan@gmail.com'],
            ['name' => 'Antoine', 'email' => 'antoine@gmail.com'],
            ['name' => 'Lasonya', 'email' => 'lasonya@gmail.com'],
            ['name' => 'Christene', 'email' => 'christene@gmail.com'],
            ['name' => 'Bradley', 'email' => 'bradley@gmail.com'],
            ['name' => 'Jeanene', 'email' => 'jeanene@gmail.com'],
            ['name' => 'Dannielle', 'email' => 'dannielle@gmail.com'],
            ['name' => 'Floria', 'email' => 'floria@gmail.com'],
        );

        foreach ($playersData as $playerIndex => $playerData) {
            $player = new Player();
            $player
                ->setName($playerData['name'])
                ->setEmail($playerData['email'])
            ;

            $manager->persist($player);

            $this->addReference(sprintf("player_%s", $playerIndex), $player);
        }

        $manager->flush();
    }
}
