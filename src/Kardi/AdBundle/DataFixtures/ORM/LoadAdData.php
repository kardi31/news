<?php
namespace Kardi\AdBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\AdBundle\Entity\Ad;
use Kardi\AdBundle\Entity\Category;
use Kardi\AdBundle\Entity\CategoryTranslation;

class LoadAdData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $komputery = new Category();

        $em->persist($komputery);

        $this->addReference('ad-komputery-i-elektronika', $komputery);

        $komputeryTranslation = new CategoryTranslation();
        $komputeryTranslation->setTitle('Komputery i elektronika');
        $komputeryTranslation->setSlug('komputery-i-elektronika');
        $komputeryTranslation->setLang('pl');
        $komputeryTranslation->setContent('To jest testowa tresc dla kategorii ogloszen komputery i elektronika');
        $komputeryTranslation->setCategory($em->merge($this->getReference('ad-komputery-i-elektronika')));

        $komputeryTranslationEn = new CategoryTranslation();
        $komputeryTranslationEn->setTitle('PC and electronics');
        $komputeryTranslationEn->setSlug('pc-and-electronics');
        $komputeryTranslationEn->setLang('en');
        $komputeryTranslationEn->setContent('This is a test content for pc and electronics ad category');
        $komputeryTranslationEn->setCategory($em->merge($this->getReference('ad-komputery-i-elektronika')));

        $em->persist($komputeryTranslation);
        $em->persist($komputeryTranslationEn);


        $motoryzacja = new Category();

        $em->persist($motoryzacja);

        $this->addReference('ad-motoryzacja', $motoryzacja);

        $motoryzacjaTranslation = new CategoryTranslation();
        $motoryzacjaTranslation->setTitle('Motoryzacja');
        $motoryzacjaTranslation->setSlug('motoryzacja');
        $motoryzacjaTranslation->setLang('pl');
        $motoryzacjaTranslation->setContent('To jest testowa tresc dla ogloszenia motoryzacji');
        $motoryzacjaTranslation->setCategory($em->merge($this->getReference('ad-motoryzacja')));

        $motoryzacjaTranslationEn = new CategoryTranslation();
        $motoryzacjaTranslationEn->setTitle('Automotive');
        $motoryzacjaTranslationEn->setSlug('automotive');
        $motoryzacjaTranslationEn->setLang('en');
        $motoryzacjaTranslationEn->setContent('Automotive ad test content');
        $motoryzacjaTranslationEn->setCategory($em->merge($this->getReference('ad-motoryzacja')));

        $em->persist($motoryzacjaTranslation);
        $em->persist($motoryzacjaTranslationEn);


        $em->flush();
        
        
        for ($j = 0; $j <= 10; $j++) {
            $ad = new Ad();
            // random if featured or not
            $ad->setFeatured(rand(0, 1) == 1);

            $categories = [$komputery, $motoryzacja];
            $randCat = array_rand($categories);
            $ad->setCategory($categories[$randCat]);

            $ad->setPhoto($em->merge($this->getReference('main-photo'.($j+20))));

            $langs = ['pl','en'];
            $randLang = array_rand($langs);

            $ad->setLang($langs[$randLang]);


            $ad->setTitle('test ad '.$langs[$randLang].' title '.$j);

            $plContent = '';
            $enContent = '';
            for ($i = 0; $i <= 30; $i++) {
                $plContent .= ' to jest testowa tresc ogloszenia polska ';
                $enContent .= ' this is a test advertisement en content';
            }

            if($randLang==0)
                $ad->setContent($plContent);
            else
                $ad->setContent($enContent);

            $ad->setPublishDate(new \DateTime("now"));
            $ad->setActive(true);
            $ad->setEmail('testemail'.$j.'@testemail.pl');
            $ad->setPhone(str_repeat($j, 5));

            $priceRand = rand(0,1);

            if($priceRand){
                $price = rand(4,50);
                $ad->setPrice($price);
                $currencyAr = ['PLN','GBP','EUR'];
                $ad->setCurrency($currencyAr[array_rand($currencyAr)]);
            }

            $ad->setTown('town'.$j);
            $ad->setCounty('county'.$j);

            $ad->setExpiredAt(new \DateTime("+5 months"));

            $em->persist($ad);

            $em->flush();
        }

    }

    public function getOrder()
    {
        return 13; // the order in which fixtures will be loaded
    }
}

?>
