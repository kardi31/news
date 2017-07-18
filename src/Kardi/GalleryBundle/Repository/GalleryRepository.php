<?php

namespace Kardi\GalleryBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Kardi\AdminBundle\Repository\DataTableRepository;

/**
 * GalleryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GalleryRepository extends DataTableRepository
{
    /**
     * @param null $limit
     * @return array
     */
    public function getGalleries($limit = null)
    {
        $qb = $this->createQueryBuilder('g');
        $qb->orderBy('g.publish_date', 'DESC');

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @param array $fields
     * @param array $data
     * @param QueryBuilder|null $queryBuilder
     * @param null|string $locale
     * @return mixed
     */
    public function getDatatableResults(array $fields, array $data, ?QueryBuilder $queryBuilder = null, ?string $locale = null)
    {
        if (!$queryBuilder) {
            $queryBuilder = $this->getCategoryQueryBuilder($locale);
        }

        return parent::getDatatableResults($fields, $data, $queryBuilder);
    }

    /**
     * @param array $fields
     * @param array $data
     * @param QueryBuilder|null $queryBuilder
     * @param null|string $locale
     * @return mixed
     */
    public function countDatatableResults(array $fields, array $data, ?QueryBuilder $queryBuilder = null, ?string $locale = null)
    {
        if (!$queryBuilder) {
            $queryBuilder = $this->getCategoryQueryBuilder($locale);
        }

        return parent::countDatatableResults($fields, $data, $queryBuilder);
    }

    /**
     * @param null|string $locale
     * @return QueryBuilder
     */
    private function getCategoryQueryBuilder(?string $locale): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->leftJoin('c.translations', 'ct')
            ->leftJoin('c.category', 'cat')
            ->leftJoin('cat.translations', 'catt')
            ->andWhere("ct.lang = :locale")
            ->andWhere("catt.lang = :locale")
            ->setParameter('locale', $locale)
            ->groupBy('c.id');
        return $qb;
    }


    public function countActiveGalleries()
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('count(g)');
        $qb->andWhere('g.active = 1');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
