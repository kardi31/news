<?php

namespace Kardi\NewsBundle\Repository;

/**
 * Class NewsRepository
 * @package Kardi\NewsBundle\Repository
 */
class NewsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBreakingNews() {
        $qb = $this->createQueryBuilder('n');
        $qb->orderBy('n.id','DESC');
        $qb->andWhere('n.breaking_news = 1');

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
