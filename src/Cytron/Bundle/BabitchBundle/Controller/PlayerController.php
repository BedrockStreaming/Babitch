<?php

namespace Cytron\Bundle\BabitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Cytron\Bundle\BabitchBundle\Form\PlayerType;
use Cytron\Bundle\BabitchBundle\Controller\PaginatorTrait;

/**
 * Class PlayerController
 *
 * @package Cytron\Bundle\BabitchBundle\Controller
 */
class PlayerController extends FOSRestController implements ClassResourceInterface
{
    use PaginatorTrait;

    /**
     * Create an player
     *
     * @param Request $request
     *
     * @return \FOS\RestBundle\View\View
     *
     * @ApiDoc(
     *  section="Player",
     *   description="Create a player",
     *   input={"class"="Cytron\Bundle\BabitchBundle\Form\PlayerType", "name"=""},
     *   output="Cytron\Bundle\BabitchBundle\Entity\Player",
     *   statusCodes={
     *     201="Player created",
     *     400="Bad request",
     *     422="Unprocessable entity"
     *   }
     * )
     */
    public function cpostAction(Request $request)
    {
        $manager = $this->get('cytron_babitch.player.manager');
        $entity  = $manager->create();
        $form    = $this->container->get('form.factory')->createNamed('', new PlayerType(), $entity);

        $form->submit($request);

        if ($form->isValid()) {
            $manager->persist($entity, true);

            return $this->view($entity, 201, array(
                'Location' => $this->generateUrl('get_player', ['id' => $entity->getId()], true),
            ));
        }

        return $this->view($form, 422);
    }

    /**
     * Get player
     *
     * @param integer $id Player id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @ApiDoc(
     *  section="Player",
     *   description="Get a player's details",
     *   output="Cytron\Bundle\BabitchBundle\Entity\Player",
     *   statusCodes={
     *     200="OK",
     *     400="Bad request",
     *     404="Player not found"
     *   }
     * )
     *
     * @Route(requirements={
     *   "id"="\d+"
     * })
     */
    public function getAction($id)
    {
        $player = $this->get('cytron_babitch.player.manager')->getRepository()->find($id);

        if (is_null($player)) {
            return $this->view(sprintf('Player with id %s not found', $id), 404);
        }

        return $this->view($player, 200);
    }

    /**
     * Player list
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return \FOS\RestBundle\View\View
     *
     * @QueryParam(name="page", requirements="\d+", default="1", description="Current page index")
     * @QueryParam(name="per_page", requirements="\d+", default="20", description="Number of elements displayed per page")
     *
     * @ApiDoc(
     *  section="Player",
     *   description="Get players list",
     *   output="Cytron\Bundle\BabitchBundle\Entity\Player",
     *   statusCodes={
     *     200="OK",
     *     400="Bad request"
     *   }
     * )
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        list($start, $limit) = $this->getStartAndLimitFromParams($paramFetcher);

        $repository = $this->get('cytron_babitch.player.manager')->getRepository();
        $entities   = $repository->findBy([], ['id' => 'DESC'], $limit, $start);

        return $this->view($entities, 200);
    }

    /**
     * Update Player
     *
     * @param Request $request Request
     * @param integer $id      Player id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @Route(requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *  section="Player",
     *   description="Update a player",
     *   input={"class"="Cytron\Bundle\BabitchBundle\Form\PlayerType", "name"=""},
     *   statusCodes={
     *     204="Player updated",
     *     400="Bad request",
     *     404="Player not found",
     *     422="Unprocessable entity"
     *   }
     * )
     */
    public function putAction(Request $request, $id)
    {
        $manager = $this->get('cytron_babitch.player.manager');
        $entity  = $manager->getRepository()->find($id);

        if (!$entity) {
            return $this->view(sprintf('Player with id %s not found', $id), 404);
        }

        $form = $this->container->get('form.factory')->createNamed('', new PlayerType(), $entity);

        $form->submit($request);

        if ($form->isValid()) {
            $manager->persist($entity, true);

            return $this->view(null, 204);
        }

        return $this->view($form, 422);
    }

    /**
     * Delete player
     *
     * @param integer $id Player id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @Route(requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *  section="Player",
     *   description="Delete a player",
     *   statusCodes={
     *     204="Player deleted",
     *     404="Player not found"
     *   }
     * )
     */
    public function deleteAction($id)
    {
        $manager = $this->get('cytron_babitch.player.manager');
        $entity  = $manager->getRepository()->find($id);

        if (!$entity) {
            return $this->view(sprintf('Player with id %s not found', $id), 404);
        }

        $manager->remove($entity, true);

        return $this->view(null, 204);
    }
}
