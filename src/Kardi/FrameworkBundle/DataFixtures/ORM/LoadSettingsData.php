<?php
namespace Kardi\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\FrameworkBundle\Entity\Settings;

class LoadSettingsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $settings = new Settings();

        $settings->setFacebook('https://www.facebook.com/Kardi-mobile-371309372997823/');
        $settings->setTwitter('https://twitter.com/apple');
        $settings->setLinkedin('https://www.linkedin.com/company-beta/162479/?pathWildcard=162479');
        $settings->setGooglePlus('https://plus.google.com/communities/107259666512014228221');

        $em->persist($settings);
        $em->flush();
    }

    public function getOrder()
    {
        return 0; // the order in which fixtures will be loaded
    }
}

?>
