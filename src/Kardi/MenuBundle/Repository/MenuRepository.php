<?php

namespace Kardi\MenuBundle\Repository;

/**
 * Class MenuRepository
 * @package Kardi\MenuBundle\Repository
 */
class MenuRepository extends \Doctrine\ORM\EntityRepository
{
    public function getMainMenu() {
        $qb = $this->createQueryBuilder('m');
        $qb->orderBy('m.id');
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        $query->useResultCache(
            true, //use it
            86400 //for 24 hours
        );

        return $query->getOneOrNullResult();
    }

    public function getSecondaryMenu() {
        $qb = $this->createQueryBuilder('m');
        $qb->orderBy('m.id');
        $qb->setFirstResult(1);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        $query->useResultCache(
            true, //use it
            86400 //for 24 hours
        );

        return $query->getOneOrNullResult();
    }
}
