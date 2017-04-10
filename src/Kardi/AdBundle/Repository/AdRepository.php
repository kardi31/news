<?php

namespace Kardi\AdBundle\Repository;

/**
 * AdRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLatestAds($locale, $limit)
    {
        $qb = $this->createQueryBuilder('n');
        $qb->where('n.lang = :lang');
        $qb->setParameter('lang', $locale);
        $qb->orderBy('n.id', 'DESC');
        $qb->setMaxResults($limit);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getLastCategoryAdList($categoryId, $limit)
    {
        $query = $this->getCategoryAdListQuery($categoryId, $limit);

        return $query->getResult();
    }

    // query to use for pagination
    public function getCategoryAdListQuery($categoryId, $locale = null, $limit = null)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->andWhere('a.category_id = :category_id');
        $qb->setParameter('category_id', $categoryId);
        $qb->orderBy('a.id', 'DESC');

        if ($locale) {
            $qb->andWhere('a.lang = :locale');
            $qb->setParameter('locale', $locale);
        }

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery();
    }
}
