<?php

namespace Kardi\FrameworkBundle\Repository;

/**
 * Settings
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Settings extends \Doctrine\ORM\EntityRepository
{
    public function getSettings() {
        $qb = $this->createQueryBuilder('s');
        $qb->orderBy('s.id','DESC');
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }
}
