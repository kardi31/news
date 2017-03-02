<?php

namespace Kardi\NewsBundle\Repository;

/**
 * Class NewsCategoryRepository
 * @package Kardi\NewsBundle\Repository
 */
class NewsCategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCategoryBySlug($slug) {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.translations','t');
        $qb->andWhere('t.slug like :slug');
        $qb->setParameter('slug', $slug);
        $qb->orderBy('c.id','DESC');
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }
}