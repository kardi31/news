<?php
namespace Kardi\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\AdBundle\Entity\Advertisment;
use Kardi\AdBundle\Entity\AdvertismentType;

class LoadAdvertismentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $advertismentType1 = new AdvertismentType();
        $advertismentType1->setSize('200x200');
        $advertismentType1->setTitle('Kwadrat w panelu bocznym');
        $this->addReference('adType1', $advertismentType1);

        $advertismentType2 = new AdvertismentType();
        $advertismentType2->setSize('300x250');
        $advertismentType2->setTitle('Prostokat w panelu bocznym');
        $this->addReference('adType2', $advertismentType2);

        $advertismentType3 = new AdvertismentType();
        $advertismentType3->setSize('728x90');
        $advertismentType3->setTitle('Dlugi prostokat w tresci strony');
        $this->addReference('adType3', $advertismentType3);

        $advertismentType4 = new AdvertismentType();
        $advertismentType4->setSize('468x60');
        $advertismentType4->setTitle('Krotki prostokat w tresci strony');
        $this->addReference('adType4', $advertismentType4);


        $em->persist($advertismentType1);
        $em->persist($advertismentType2);
        $em->persist($advertismentType3);
        $em->persist($advertismentType4);

        $em->flush();
        for ($j = 0; $j <= 20; $j++) {
            $ad = new Advertisment();
            $ad->setTitle('Advertisment '.$j);
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
