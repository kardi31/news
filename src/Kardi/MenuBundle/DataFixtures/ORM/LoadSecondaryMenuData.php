<?php
// src/Kardi/MenuBundle/DataFixtures/ORM/LoadMenuData.php
namespace Kardi\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\MenuBundle\Entity\Menu;

class LoadSecondaryMenuDataMenuData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $podmenu = new Menu();
        $podmenu->setTitle('Podmenu');

        $em->persist($podmenu);

        $em->flush();

        $this->addReference('podmenu', $podmenu);

    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}
?>
