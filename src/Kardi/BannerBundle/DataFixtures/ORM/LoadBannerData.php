<?php
namespace Kardi\BannerBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\BannerBundle\Entity\Banner;
use Kardi\BannerBundle\Entity\BannerType;

class LoadBannerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $bannerType1 = new BannerType();
        $bannerType1->setSize('200x200');
        $bannerType1->setTitle('Kwadrat w panelu bocznym');
        $this->addReference('adType1', $bannerType1);

        $bannerType2 = new BannerType();
        $bannerType2->setSize('300x250');
        $bannerType2->setTitle('Prostokat w panelu bocznym');
        $this->addReference('adType2', $bannerType2);

        $bannerType3 = new BannerType();
        $bannerType3->setSize('728x90');
        $bannerType3->setTitle('Dlugi prostokat w tresci strony');
        $this->addReference('adType3', $bannerType3);

        $bannerType4 = new BannerType();
        $bannerType4->setSize('468x60');
        $bannerType4->setTitle('Krotki prostokat w tresci strony');
        $this->addReference('adType4', $bannerType4);


        $em->persist($bannerType1);
        $em->persist($bannerType2);
        $em->persist($bannerType3);
        $em->persist($bannerType4);

        $em->flush();
        for ($j = 0; $j <= 20; $j++) {
            $ad = new Banner();
            $ad->setTitle('banner '.$j);
            $ad->setWebsite('http://www.kardimobile.pl');

            $rand = rand(1,4);

            $ad->setType($this->getReference('adType'.$rand));

            $em->persist($ad);

            $em->flush();
        }


    }

    public function getOrder()
    {
        return 8; // the order in which fixtures will be loaded
    }
}

?>
