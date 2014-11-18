<?php

namespace Cytron\Bundle\BabitchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cytron\Bundle\BabitchBundle\Entity\Game;
use Cytron\Bundle\BabitchBundle\Entity\GamePlayer;
use Cytron\Bundle\BabitchBundle\Entity\Goal;
use Cytron\Bundle\BabitchBundle\Entity\GoalPlayer;

class LoadGameData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $gamesData = array(
            array(
                'players' => array(
                    ['player' => 'player_1', 'team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_ATTACK],
                    ['player' => 'player_2', 'team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_DEFENSE],
                    ['player' => 'player_3', 'team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_ATTACK],
                    ['player' => 'player_4', 'team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_DEFENSE],
                ),
                'blueScore' => 2,
                'redScore' => 10,
                'goals' => array(
                    ['player' => 'player_1', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_1', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_1', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_1', 'conceder' => 'player_3', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_2', 'conceder' => 'player_3', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_2', 'conceder' => 'player_3', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_2', 'conceder' => 'player_4', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_1', 'conceder' => 'player_4', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_1', 'conceder' => 'player_4', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_3', 'conceder' => 'player_1', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_2', 'conceder' => 'player_2', 'position' => Goal::POSITION_ATTACK, 'autogoal' => true],
                    ['player' => 'player_1', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                ),
            ),
            array(
                'players' => array(
                    ['player' => 'player_5', 'team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_ATTACK],
                    ['player' => 'player_6', 'team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_DEFENSE],
                    ['player' => 'player_3', 'team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_ATTACK],
                    ['player' => 'player_8', 'team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_DEFENSE],
                ),
                'blueScore' => 7,
                'redScore' => 10,
                'goals' => array(
                    ['player' => 'player_5', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_5', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_5', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_5', 'conceder' => 'player_3', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_3', 'conceder' => 'player_3', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => true],
                    ['player' => 'player_3', 'conceder' => 'player_3', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => true],
                    ['player' => 'player_3', 'conceder' => 'player_3', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => true],
                    ['player' => 'player_5', 'conceder' => 'player_8', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_5', 'conceder' => 'player_8', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_3', 'conceder' => 'player_5', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_3', 'conceder' => 'player_6', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_8', 'conceder' => 'player_6', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_8', 'conceder' => 'player_6', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_8', 'conceder' => 'player_5', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_3', 'conceder' => 'player_5', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_3', 'conceder' => 'player_5', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_5', 'conceder' => 'player_3', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                ),
            ),
            array(
                'players' => array(
                    ['player' => 'player_9', 'team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_ATTACK],
                    ['player' => 'player_7', 'team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_DEFENSE],
                    ['player' => 'player_4', 'team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_ATTACK],
                    ['player' => 'player_0', 'team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_DEFENSE],
                ),
                'blueScore' => 10,
                'redScore' => 5,
                'goals' => array(
                    ['player' => 'player_4', 'conceder' => 'player_9', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_4', 'conceder' => 'player_9', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_4', 'conceder' => 'player_9', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_4', 'conceder' => 'player_9', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_0', 'conceder' => 'player_9', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_0', 'conceder' => 'player_9', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_0', 'conceder' => 'player_7', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_4', 'conceder' => 'player_7', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_4', 'conceder' => 'player_7', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_9', 'conceder' => 'player_4', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_9', 'conceder' => 'player_0', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_7', 'conceder' => 'player_0', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_7', 'conceder' => 'player_0', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_7', 'conceder' => 'player_4', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_9', 'conceder' => 'player_4', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                    ['player' => 'player_9', 'conceder' => 'player_4', 'position' => Goal::POSITION_DEFENSE, 'autogoal' => false],
                    ['player' => 'player_4', 'conceder' => 'player_9', 'position' => Goal::POSITION_ATTACK, 'autogoal' => false],
                ),
            ),
        );

        foreach ($gamesData as $gameData) {
            $game = new Game();
            $game
                ->setBlueScore($gameData['blueScore'])
                ->setRedScore($gameData['redScore'])
            ;

            foreach ($gameData['players'] as $playerData) {
                $player = new GamePlayer();
                $player
                    ->setGame($game)
                    ->setPlayer($this->getReference($playerData['player']))
                    ->setTeam($playerData['team'])
                    ->setPosition($playerData['position'])
                ;

                $game->addGamePlayer($player);
            }

            foreach ($gameData['goals'] as $goalData) {
                $goal = new Goal();
                $goal
                    ->setGame($game)
                    ->setPlayer($this->getReference($goalData['player']))
                    ->setConceder($this->getReference($goalData['conceder']))
                    ->setPosition($goalData['position'])
                    ->setAutogoal($goalData['autogoal'])
                    ->setScoredAt(new \DateTime())
                ;

                $game->addGoal($goal);
            }

            $manager->persist($game);
        }

        $manager->flush();
    }
}
