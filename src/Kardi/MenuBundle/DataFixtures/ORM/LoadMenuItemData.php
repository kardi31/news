<?php
namespace Kardi\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Kardi\MenuBundle\Entity\MenuItem;
use Kardi\MenuBundle\Entity\MenuItemTranslation;

class LoadMenuItemData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $contact = new MenuItem();
        $contact->setMenu($em->merge($this->getReference('menu-glowne')));

        $treeRepository = $em->getRepository('KardiMenuBundle:MenuItem');
        $treeRepository->persistAsFirstChild($contact);

        $this->addReference('contact', $contact);

        $contactTranslation = new MenuItemTranslation();
        $contactTranslation->setTitle('Kontakt');
        $contactTranslation->setSlug('kontakt');
        $contactTranslation->setLang('pl');
        $contactTranslation->setMenuItem($em->merge($this->getReference('contact')));


        $contactTranslationEn = new MenuItemTranslation();
        $contactTranslationEn->setTitle('Contact');
        $contactTranslationEn->setSlug('contact');
        $contactTranslationEn->setLang('en');
        $contactTranslationEn->setMenuItem($em->merge($this->getReference('contact')));

        $em->persist($contactTranslation);
        $em->persist($contactTranslationEn);

        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
?>
