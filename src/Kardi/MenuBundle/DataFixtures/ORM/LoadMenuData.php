<?php
// src/Kardi/MenuBundle/DataFixtures/ORM/LoadMenuData.php
namespace Kardi\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\MenuBundle\Entity\Menu;

class LoadMenuData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $glowne = new Menu();
        $glowne->setTitle('Glowne');

        $em->persist($glowne);

        $em->flush();

        $this->addReference('menu-glowne', $glowne);

    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
?>