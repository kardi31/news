<?php

namespace Kardi\UserBundle\Repository;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return array
     */
    public function getAdminUsers()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->like('u.roles', ':role_super_admin'),
            $qb->expr()->like('u.roles', ':role_admin')
        ));
        $qb->setParameters(['role_super_admin' => '%ROLE_SUPER_ADMIN%', 'role_admin' => '%ROLE_ADMIN_USER%']);

        return $qb->getQuery()->getResult();
    }


    public function countActiveAdminUsers()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('count(u)');
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->like('u.roles', ':role_super_admin'),
            $qb->expr()->like('u.roles', ':role_admin')
        ));
        $qb->setParameters(['role_super_admin' => '%ROLE_SUPER_ADMIN%', 'role_admin' => '%ROLE_ADMIN_USER%']);
        $qb->andWhere('u.enabled = 1');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
