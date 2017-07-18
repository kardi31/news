<?php

namespace Kardi\NewsBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Class CommentRepository
 * @package Kardi\MenuBundle\Repository
 */
class CommentRepository extends NestedTreeRepository
{
    public function getLatestComments($limit) {
        $qb = $this->createQueryBuilder('c');
        $qb->orderBy('c.id','DESC');
        $qb->setMaxResults($limit);
        $qb->where('c.active = 1');
        
        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getNewsMainComments($newsId) {
        $qb = $this->createQueryBuilder('c');
        $qb->orderBy('c.id','DESC');
        $qb->where('c.active = 1');
        $qb->andWhere('c.news_id = :news_id');
        $qb->andWhere('c.lvl = 0');
        $qb->setParameter('news_id', $newsId);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function countAllNewsComments($newsId) {
        $qb = $this->createQueryBuilder('c');
        $qb->select('count(c) as cnt');
        $qb->orderBy('c.id','DESC');
        $qb->where('c.active = 1');
        $qb->andWhere('c.news_id = :news_id');
        $qb->setParameter('news_id', $newsId);

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    public function countActiveComments()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('count(c)');
        $qb->andWhere('c.active = 1');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
