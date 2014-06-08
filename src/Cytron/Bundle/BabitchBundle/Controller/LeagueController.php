<?php

namespace Cytron\Bundle\BabitchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Cytron\Bundle\BabitchBundle\Form\LeagueType;
use Cytron\Bundle\BabitchBundle\Controller\PaginatorTrait;

/**
 * Class LeagueController
 *
 * @package Cytron\Bundle\BabitchBundle\Controller
 */
class LeagueController extends FOSRestController implements ClassResourceInterface
{
    use PaginatorTrait;

    /**
     * Create an league
     *
     * @param Request $request
     *
     * @return \FOS\RestBundle\View\View
     *
     * @ApiDoc(
     *   section="League",
     *   description="Create a league",
     *   input={"class"="Cytron\Bundle\BabitchBundle\Form\LeagueType", "name"=""},
     *   output="Cytron\Bundle\BabitchBundle\Entity\League",
     *   statusCodes={
     *     201="League created",
     *     400="Bad request",
     *     422="Unprocessable entity"
     *   }
     * )
     */
    public function cpostAction(Request $request)
    {
        $manager = $this->get('cytron_babitch.league.manager');
        $entity  = $manager->create();
        $form    = $this->container->get('form.factory')->createNamed('', new LeagueType(), $entity);

        $form->submit($request);

        if ($form->isValid()) {
            $manager->persist($entity, true);

            return $this->view($entity, 201, array(
                'Location' => $this->generateUrl('get_league', ['id' => $entity->getId()], true),
            ));
        }

        return $this->view($form, 422);
    }

    /**
     * Get league
     *
     * @param integer $id League id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @ApiDoc(
     *   section="League",
     *   description="Get a league's details",
     *   output="Cytron\Bundle\BabitchBundle\Entity\League",
     *   statusCodes={
     *     200="OK",
     *     400="Bad request",
     *     404="League not found"
     *   }
     * )
     *
     * @Route(requirements={
     *   "id"="\d+"
     * })
     */
    public function getAction($id)
    {
        $league = $this->get('cytron_babitch.league.manager')->getRepository()->find($id);

        if (is_null($league)) {
            return $this->view(sprintf('League with id %s not found', $id), 404);
        }

        return $this->view($league, 200);
    }

    /**
     * League list
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return \FOS\RestBundle\View\View
     *
     * @QueryParam(name="page", requirements="\d+", default="1", description="Current page index")
     * @QueryParam(name="per_page", requirements="\d+", default="50", description="Number of elements displayed per page")
     *
     * @ApiDoc(
     *   section="League",
     *   description="Get leagues list",
     *   output="Cytron\Bundle\BabitchBundle\Entity\League",
     *   statusCodes={
     *     200="OK",
     *     400="Bad request"
     *   }
     * )
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        list($start, $limit) = $this->getStartAndLimitFromParams($paramFetcher);

        $repository = $this->get('cytron_babitch.league.manager')->getRepository();
        $entities   = $repository->findBy([], ['id' => 'DESC'], $limit, $start);

        return $this->view($entities, 200);
    }

    /**
     * Update League
     *
     * @param Request $request Request
     * @param integer $id      League id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @Route(requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *   section="League",
     *   description="Update a league",
     *   input={"class"="Cytron\Bundle\BabitchBundle\Form\LeagueType", "name"=""},
     *   statusCodes={
     *     204="League updated",
     *     400="Bad request",
     *     404="League not found",
     *     422="Unprocessable entity"
     *   }
     * )
     */
    public function putAction(Request $request, $id)
    {
        $manager = $this->get('cytron_babitch.league.manager');
        $entity  = $manager->getRepository()->find($id);

        if (!$entity) {
            return $this->view(sprintf('League with id %s not found', $id), 404);
        }

        $form = $this->container->get('form.factory')->createNamed('', new LeagueType(), $entity);

        $form->submit($request);

        if ($form->isValid()) {
            $manager->persist($entity, true);

            return $this->view(null, 204);
        }

        return $this->view($form, 422);
    }

    /**
     * Delete league
     *
     * @param integer $id League id
     *
     * @return \FOS\RestBundle\View\View
     *
     * @Route(requirements={"id"="\d+"})
     *
     * @ApiDoc(
     *   section="League",
     *   description="Delete a league",
     *   statusCodes={
     *     204="League deleted",
     *     404="League not found"
     *   }
     * )
     */
    public function deleteAction($id)
    {
        $manager = $this->get('cytron_babitch.league.manager');
        $entity  = $manager->getRepository()->find($id);

        if (!$entity) {
            return $this->view(sprintf('League with id %s not found', $id), 404);
        }

        $manager->remove($entity, true);

        return $this->view(null, 204);
    }
}
