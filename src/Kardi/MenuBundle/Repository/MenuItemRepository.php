<?php

namespace Kardi\MenuBundle\Repository;

/**
 * Class MenuRepository
 * @package Kardi\MenuBundle\Repository
 */
class MenuItemRepository extends \Doctrine\ORM\EntityRepository
{
    public function fetchMenuTree($menuId)
    {
        $qb = $this->createQueryBuilder('mi');
        $qb->andWhere('mi.menu_id = :menuId');
        $qb->setParameter('menuId', $menuId);
        $qb->orderBy('mi.parent', 'asc');

        $query = $qb->getQuery();

        $result = $query->getResult();

        return $this->prepareMenuTreeFromResult($result);
    }

    private function prepareMenuTreeFromResult($result)
    {
        $resultArray = [];

        foreach ($result as $row) {
            $resultArray[$row->getId()] = $row;
        }

        foreach ($resultArray as $id => $item) {
            if ($item->getParent()) {
                $resultArray[$item->getParent()]->addChild($item);
            }
        }

        foreach ($resultArray as $id => $item) {
            if ($item->getParent()) {
                unset($resultArray[$id]);
            }
        }

        usort($resultArray, [$this, 'sortByPos']);
        $this->sortChildren($resultArray);

        return $resultArray;
    }

    private function sortChildren($resultArray)
    {
        foreach ($resultArray as $key => $row) {
            if ($row->hasChildren()) {
                $row->sortChildren();
                foreach ($row->getChildren() as $child) {
                    $this->sortChildren($child);
                }
            }

            $resultArray[$key] = $row;
        }
    }

    private function sortByPos($a, $b)
    {
        return $a->getPos() > $b->getPos() ? 1 : -1;
    }


}
