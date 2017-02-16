<?php

namespace Kardi\MenuBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class MenuRepository extends EntityRepository
{
//    public function getMainMenu() {
//        $qb = $this->createQueryBuilder('m');
//        $qb
//            ->orderBy('id');
//
//        $query = $qb->getQuery();
//
//        $query->useResultCache(
//            true, //use it
//            86400 //for 24 hours
//        );
//
//        return $query->getResult();
//    }
}