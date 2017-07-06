<?php

namespace Kardi\NewsBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Kardi\AdminBundle\Repository\DataTableRepository;

/**
 * Class CategoryRepository
 * @package Kardi\NewsBundle\Repository
 */
class CategoryRepository extends DataTableRepository
{
    /**
     * @param string $locale
     * @param array $order
     * @return mixed
     */
    public function getAllCategories(string $locale, array $order = [])
    {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.translations', 'ct');
        $qb->andWhere($qb->expr()->like('ct.lang', ':locale'));
        $qb->setParameter('locale', $locale);

        if ($order) {
            $qb->addOrderBy($order[0], $order[1]);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getCategoryBySlug(string $slug)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->join('c.translations', 't');
        $qb->andWhere('t.slug like :slug');
        $qb->setParameter('slug', $slug);
        $qb->orderBy('c.id', 'DESC');
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

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
            ->select('c, count(n) as news_count')
            ->leftJoin('c.translations', 'ct')
            ->leftJoin('c.news', 'n')
            ->andWhere("ct.lang = :locale")
            ->setParameter('locale', $locale)
            ->groupBy('c.id');
        return $qb;
    }
}
