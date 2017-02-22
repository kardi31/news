<?php

namespace Kardi\MenuBundle\Repository;

use Gedmo\Tree\Traits\Repository\ORM\NestedTreeRepositoryTrait;
/**
 * Class MenuRepository
 * @package Kardi\MenuBundle\Repository
 */
class MenuRepository extends \Doctrine\ORM\EntityRepository
{
    use NestedTreeRepositoryTrait;

    public function __construct(EntityManager $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->initializeTreeRepository($em, $class);
    }
}
