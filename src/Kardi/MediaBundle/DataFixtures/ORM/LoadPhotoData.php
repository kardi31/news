<?php
namespace Kardi\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\MediaBundle\Entity\Photo;

class LoadPhotoData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {

        for ($i = 0; $i <= 50; $i++) {
            $mainPhoto = new Photo();

            $treeRepository = $em->getRepository('KardiMediaBundle:Photo');

            $this->addReference('main-photo'.$i, $mainPhoto);
            $em->persist($mainPhoto);
            $em->flush();
            $childrenNo = rand(1, 7);

            for ($j = 0; $j < $childrenNo; $j++) {
                $subPhoto = new Photo();
                $treeRepository->persistAsLastChildOf($subPhoto, $mainPhoto);
                $em->persist($subPhoto);
                $em->flush();
            }

        }


    }

    public function getOrder()
    {
        return 10; // the order in which fixtures will be loaded
    }
}

?>
