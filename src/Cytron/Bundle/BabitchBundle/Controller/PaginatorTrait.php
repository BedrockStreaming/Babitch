<?php

namespace Cytron\Bundle\BabitchBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;

/**
 * Class PaginatorTrait
 *
 * @author Adrien Samson <asamson.externe@m6.fr>
 */
trait PaginatorTrait
{
    /**
     * Get start and limit from page and perPage
     *
     * @param int $page       Page number
     * @param int $perPage    Items per page
     * @param int $maxPerPage Max items per page
     *
     * @return array(start, limit)
     */
    public function getStartAndLimit($page, $perPage = 10, $maxPerPage = 300)
    {
        $page    = max($page, 1);
        $perPage = max(min($perPage, $maxPerPage), 1);
        $start   = ($page - 1) * $perPage;

        return array($start, $perPage);
    }

    /**
     * Get start and limit from ParamFetcher
     *
     * @param ParamFetcher $paramFetcher ParamFetcher
     *
     * @return array(start, limit)
     */
    public function getStartAndLimitFromParams(ParamFetcher $paramFetcher)
    {
        return $this->getStartAndLimit($paramFetcher->get('page'), $paramFetcher->get('per_page'));
    }
}
