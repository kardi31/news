<?php
namespace Kardi\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\MenuBundle\Entity\MenuItem;
use Kardi\MenuBundle\Entity\MenuItemTranslation;

class LoadSecondaryMenuItemData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $treeRepository = $em->getRepository('KardiMenuBundle:MenuItem');

        $zkraju = new MenuItem();
        $zkraju->setMenu($em->merge($this->getReference('podmenu')));


        $treeRepository->persistAsFirstChild($zkraju);

        $this->addReference('z-kraju', $zkraju);

        $zkrajuTranslation = new MenuItemTranslation();
        $zkrajuTranslation->setTitle('Z kraju');
        $zkrajuTranslation->setSlug('z-kraju');
        $zkrajuTranslation->setLang('pl');
        $zkrajuTranslation->setMenuItem($em->merge($this->getReference('z-kraju')));


        $zkrajuTranslationEn = new MenuItemTranslation();
        $zkrajuTranslationEn->setTitle('Domestic news');
        $zkrajuTranslationEn->setSlug('domestic-news');
        $zkrajuTranslationEn->setLang('en');
        $zkrajuTranslationEn->setMenuItem($em->merge($this->getReference('z-kraju')));


        $em->persist($zkrajuTranslation);
        $em->persist($zkrajuTranslationEn);

        $zeswiata = new MenuItem();
        $zeswiata->setMenu($em->merge($this->getReference('podmenu')));


        $treeRepository->persistAsFirstChild($zeswiata);
//
        $this->addReference('ze-swiata', $zeswiata);

        $zeswiataTranslation = new MenuItemTranslation();
        $zeswiataTranslation->setTitle('Ze swiata');
        $zeswiataTranslation->setSlug('ze-swiata');
        $zeswiataTranslation->setLang('pl');
        $zeswiataTranslation->setMenuItem($em->merge($this->getReference('ze-swiata')));


        $zeswiataTranslationEn = new MenuItemTranslation();
        $zeswiataTranslationEn->setTitle('Global news');
        $zeswiataTranslationEn->setSlug('global-news');
        $zeswiataTranslationEn->setLang('en');
        $zeswiataTranslationEn->setMenuItem($em->merge($this->getReference('ze-swiata')));

        $em->persist($zeswiataTranslation);
        $em->persist($zeswiataTranslationEn);

        $em->flush();
    }

    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}
?>
