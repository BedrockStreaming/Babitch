<?php

namespace Cytron\Bundle\BabitchBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Player repository
 */
class PlayerRepository extends EntityRepository
{

    /**
     * Finds all players filter by game Id.
     *
     * @param integer $gameId Game Id
     * @param integer $limit  Limit
     * @param integer $start  Start
     *
     * @return array The entities.
     */
    public function findByGameId($gameId, $limit = null, $start = 0)
    {
        $qb = $this
            ->createQueryBuilder('Player')
            ->leftJoin('Player.gamePlayers', 'gamePlayer')
            ->leftJoin('gamePlayer.game', 'Game')
            ->where('Game.id = :gameId');

        if ($limit > 0) {
            $qb->setMaxResults($limit);
        }

        $qb->setFirstResult($start);

        return $qb->setParameter('gameId', $gameId)
            ->getQuery()
            ->getResult();
    }
}
