<?php
// src/Kardi/MenuBundle/DataFixtures/ORM/LoadMenuItemData.php
namespace Kardi\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\MenuBundle\Entity\MenuItem;

class LoadMenuItemData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $contact = new MenuItem();
        $contact->setTitle('Kontakt');
        $contact->setSlug('kontakt');
        $contact->setMenu($em->merge($this->getReference('menu-glowne')));
        $contact->setLft(1);
        $contact->setRgt(2);
        $contact->setLvl(1);


        $em->persist($contact);

        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
?>