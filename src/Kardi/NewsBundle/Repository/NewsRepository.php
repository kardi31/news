<?php

namespace Kardi\NewsBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Kardi\AdminBundle\Repository\DataTableRepository;

/**
 * Class NewsRepository
 * @package Kardi\NewsBundle\Repository
 */
class NewsRepository extends DataTableRepository
{
    public function getBreakingNews()
    {
        $qb = $this->createQueryBuilder('n');
        $qb->orderBy('n.id', 'DESC');
        $qb->andWhere('n.breakingNews = 1');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getLatestNews()
    {
        $qb = $this->createQueryBuilder('n');
        $qb->orderBy('n.id', 'DESC');
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getLastNewsList($offset, $limit)
    {
        $qb = $this->createQueryBuilder('n');
        $qb->orderBy('n.id', 'DESC');
        $qb->setFirstResult($offset);
        $qb->setMaxResults($limit);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getLastCategoryNewsList($categoryId, $limit)
    {
        $query = $this->getCategoryNewsListQuery($categoryId, $limit);

        return $query->getResult();
    }

    // query to use for pagination
    public function getCategoryNewsListQuery($categoryId, $limit)
    {
        $qb = $this->createQueryBuilder('n');
        $qb->andWhere('n.categoryId = :categoryId');
        $qb->setParameter('categoryId', $categoryId);
        $qb->orderBy('n.id', 'DESC');

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery();
    }

    // query to use for pagination
    public function getTagNewsListQuery($tagId, $limit)
    {
        $qb = $this->createQueryBuilder('n');
        $qb->innerJoin('n.tags', 't');
        $qb->andWhere('t.id = :tag_id');
        $qb->setParameter('tag_id', $tagId);
        $qb->orderBy('n.id', 'DESC');

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery();
    }

    // query to use for pagination
    public function getAllNewsListQuery($limit = null)
    {
        $qb = $this->createQueryBuilder('n');
        $qb->orderBy('n.id', 'DESC');

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery();
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
            $queryBuilder = $this->getNewsQueryBuilder($locale);
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
            $queryBuilder = $this->getNewsQueryBuilder($locale);
        }

        return parent::countDatatableResults($fields, $data, $queryBuilder);
    }

    /**
     * @param null|string $locale
     * @return QueryBuilder
     */
    private function getNewsQueryBuilder(?string $locale): QueryBuilder
    {
        $qb = $this->createQueryBuilder('n')
            ->select('n, count(c) as comment_count')
            ->leftJoin('n.comments', 'c')
            ->leftJoin('n.translations', 'nt')
            ->leftJoin('n.category', 'cat')
            ->leftJoin('cat.translations', 'catt')
            ->andWhere("nt.lang = :locale")
            ->andWhere("catt.lang = :locale")
            ->setParameter('locale', $locale)
            ->groupBy('n.id');
        return $qb;
    }
}
