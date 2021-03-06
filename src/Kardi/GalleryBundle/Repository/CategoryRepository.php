<?php

namespace Kardi\GalleryBundle\Repository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param string $locale
     * @return array
     */
    public function getCategoryNames(string $locale)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('c.id, t.title');
        $qb->join('c.translations', 't');
        $qb->orderBy('t.title', 'DESC');
        $qb->andWhere('t.lang = :locale');
        $qb->setParameter('locale', $locale);

        return $qb->getQuery()->getArrayResult();
    }
}
