<?php

namespace Cytron\Bundle\BabitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Cytron\Bundle\BabitchBundle\Form\GameType;
use Cytron\Bundle\BabitchBundle\Controller\PaginatorTrait;

/**
 * Class GameController
 *
 * @package Cytron\Bundle\BabitchBundle\Controller
 */
class GameController extends FOSRestController implements ClassResourceInterface
{
    use PaginatorTrait;

    /**
     * Create a game
     *
     * @param Request $request
     *
     * @return \FOS\RestBundle\View\View
     *
     * @ApiDoc(
     *  section="Game",
     *   description="Create a game",
     *   input={"class"="Cytron\Bundle\BabitchBundle\Form\GameType", "name"=""},
     *   output="Cytron\Bundle\BabitchBundle\Entity\Game",
     *   statusCodes={
     *     201="Game created",
     *     400="Bad request",
     *     422="Unprocessable entity"
     *   }
     * )
     */
    public function cpostAction(Request $request)
    {
        $manager = $this->get('cytron_babitch.game.manager');
        $entity  = $manager->create();
        $form    = $this->container->get('form.factory')->createNamed('', new GameType(), $entity);

        $form->submit($request);

        if ($form->isValid()) {
            $manager->persist($entity, true);

            return $this->view($entity, 201, array(
                'Location' => $this->generateUrl('get_game', ['id' => $entity->getId()], true),
            ));
        }

        return $this->view($form, 422);
    }

    /**
     * Get a game's details
     *
     * @param integer $id Game id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @ApiDoc(
     *  section="Game",
     *   description="Get a game's details",
     *   output="Cytron\Bundle\BabitchBundle\Entity\Game",
     *   statusCodes={
     *     200="OK",
     *     400="Bad request",
     *     404="Game not found"
     *   }
     * )
     *
     * @Route(requirements={
     *   "id"="\d+"
     * })
     */
    public function getAction($id)
    {
        $game = $this->get('cytron_babitch.game.manager')->getRepository()->find($id);

        if (is_null($game)) {
            return $this->view(sprintf('Game with id %s not found', $id), 404);
        }

        return $this->view($game, 200);
    }

    /**
     * Get games list
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return \FOS\RestBundle\View\View
     *
     * @QueryParam(name="page", requirements="\d+", default="1", description="Current page index")
     * @QueryParam(name="per_page", requirements="\d+", default="50", description="Number of elements displayed per page")
     *
     * @ApiDoc(
     *  section="Game",
     *   description="Get games list",
     *   output="Cytron\Bundle\BabitchBundle\Entity\Game",
     *   statusCodes={
     *     200="OK",
     *     400="Bad request"
     *   }
     * )
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        list($start, $limit) = $this->getStartAndLimitFromParams($paramFetcher);

        $repository = $this->get('cytron_babitch.game.manager')->getRepository();
        $entities   = $repository->findBy([], ['id' => 'DESC'], $limit, $start);

        return $this->view($entities, 200);
    }

    /**
     * Update a game
     *
     * @param Request $request Request
     * @param integer $id      Game id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @Route(requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *  section="Game",
     *   description="Update a game",
     *   input={"class"="Cytron\Bundle\BabitchBundle\Form\GameType", "name"=""},
     *   statusCodes={
     *     204="Game updated",
     *     400="Bad request",
     *     404="Game not found",
     *     422="Unprocessable entity"
     *   }
     * )
     */
    public function putAction(Request $request, $id)
    {
        $manager = $this->get('cytron_babitch.game.manager');
        $entity  = $manager->getRepository()->find($id);

        if (!$entity) {
            return $this->view(sprintf('Game with id %s not found', $id), 404);
        }

        $form = $this->container->get('form.factory')->createNamed('', new GameType(), $entity);

        $form->submit($request);

        if ($form->isValid()) {
            $manager->persist($entity, true);

            return $this->view(null, 204);
        }

        return $this->view($form, 422);
    }

    /**
     * Delete a game
     *
     * @param integer $id Game id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @Route(requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *  section="Game",
     *   description="Delete a game",
     *   statusCodes={
     *     204="Game deleted",
     *     404="Game not found"
     *   }
     * )
     */
    public function deleteAction($id)
    {
        $manager = $this->get('cytron_babitch.game.manager');
        $entity  = $manager->getRepository()->find($id);

        if (!$entity) {
            return $this->view(sprintf('Game with id %s not found', $id), 404);
        }

        $manager->remove($entity, true);

        return $this->view(null, 204);
    }
}
