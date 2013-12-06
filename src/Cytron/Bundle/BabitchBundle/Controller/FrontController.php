<?php

namespace Cytron\Bundle\BabitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Cytron\Bundle\BabitchBundle\Form\GameType;
use Cytron\Bundle\BabitchBundle\Entity\GamePlayer;

/**
 * Class GameController
 *
 * @package Cytron\Bundle\BabitchBundle\Controller
 */
class FrontController extends Controller
{
    /**
     * Index action.
     *
     * @Route("/", name="game")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $gameManager       = $this->get('cytron_babitch.game.manager');
        $gamePlayerManager = $this->get('cytron_babitch.game_player.manager');

        // create game and players
        $game = $gameManager->create();


        $gameComposition = array(
            ['team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_ATTACK],
            ['team' => GamePlayer::TEAM_RED, 'position' => GamePlayer::POSITION_DEFENSE],
            ['team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_ATTACK],
            ['team' => GamePlayer::TEAM_BLUE, 'position' => GamePlayer::POSITION_DEFENSE],
        );

        foreach ($gameComposition as $composition) {
            $gamePlayer = $gamePlayerManager->create();
            $gamePlayer
                ->setTeam($composition['team'])
                ->setPosition($composition['position']);
            
            $game->addGamePlayer($gamePlayer);
        }

        $form = $this->container->get('form.factory')->createNamed('', new GameType(), $game);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $gameManager->persist($game, true);

                return $this->redirect($this->generateUrl('game'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }
}
