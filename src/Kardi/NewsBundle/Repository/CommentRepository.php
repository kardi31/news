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

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
