<?php

namespace Kardi\AdminBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Kardi\AdminBundle\Helper\Date;
use Kardi\FrameworkBundle\Helper\Text;

class DataTableRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param array $fields
     * @param array $data
     * @param QueryBuilder $qb
     * @return mixed
     */
    public function getDatatableResults(array $fields, array $data, QueryBuilder $qb)
    {
        $qb->setMaxResults($data['length']);
        $qb->setFirstResult($data['start']);

        $keys = array_keys($fields);

        $qb = $this->prepareWhereStatement($fields, $data, $qb, $keys);

        $qb = $this->prepareOrderStatement($fields, $data, $qb, $keys);

        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * @param array $fields
     * @param array $data
     * @param QueryBuilder $qb
     * @param array $keys
     * @return QueryBuilder
     */
    private function prepareWhereStatement(array $fields, array $data, QueryBuilder $qb, array $keys)
    {
        foreach ($data['columns'] as $key => $column) {
            if (!empty($column['search']['value'])) {
                $searchValue = $column['search']['value'];
                $fieldName = $fields[$keys[$key]];

                // if searching by groupped field (count)
                if (strpos(strtolower($fieldName), 'count') !== false) {
                    $qb->having($qb->expr()->eq($fieldName, $searchValue));
                } elseif (strpos($searchValue, '-+-') !== false) {
                    // search for date ranges
                    $rangeValues = explode('-+-', $searchValue);

                    if (!empty($rangeValues[0]) && !empty($rangeValues[1])) {
                        $qb->andWhere($qb->expr()->between($fieldName, Text::wrapInQuotes(Date::transform($rangeValues[0])), Text::wrapInQuotes(Date::transform($rangeValues[1]))));
                    }
                    elseif (!empty($rangeValues[0])) {
                        $qb->andWhere($qb->expr()->lte($fieldName, Text::wrapInQuotes(Date::transform($rangeValues[0]))));
                    }
                    else {
                        $qb->andWhere($qb->expr()->gte($fieldName, Text::wrapInQuotes(Date::transform($rangeValues[1]))));
                    }
                } elseif (is_numeric($searchValue)) {
                    // if numeric value
                    $qb->andWhere($qb->expr()->eq($fieldName, $searchValue));
                } else {
                    // if string
                    $qb->andWhere($qb->expr()->like($fieldName, "'" . $searchValue . "%'"));
                }
            }
        }

        return $qb;
    }

    /**
     * @param array $fields
     * @param array $data
     * @param QueryBuilder $qb
     * @param array $keys
     * @return QueryBuilder
     */
    private function prepareOrderStatement(array $fields, array $data, QueryBuilder $qb, array $keys)
    {
        $orderColumn = $data['order'][0]['column'];

        $orderField = $fields[$keys[$orderColumn]] ?? null;

        if ($orderField) {
            $qb->orderBy($orderField, $data['order'][0]['dir']);
        }

        return $qb;
    }

}
