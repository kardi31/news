<?php
namespace Kardi\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\GalleryBundle\Entity\Category;
use Kardi\GalleryBundle\Entity\CategoryTranslation;
use Kardi\GalleryBundle\Entity\Gallery;
use Kardi\GalleryBundle\Entity\GalleryTranslation;

class LoadGalleryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $zeswiata = new Category();

        $em->persist($zeswiata);

        $this->addReference('zeswiata-gallery-cool', $zeswiata);

        $zeswiataTranslation = new CategoryTranslation();
        $zeswiataTranslation->setTitle('galeria ze swiata');
        $zeswiataTranslation->setSlug('galeria-ze-swiata');
        $zeswiataTranslation->setLang('pl');
        $zeswiataTranslation->setContent('To jest testowa tresc dla galerii ze swiata');
        $zeswiataTranslation->setCategory($em->merge($this->getReference('zeswiata-gallery-cool')));

        $zeswiataTranslationEn = new CategoryTranslation();
        $zeswiataTranslationEn->setTitle('Global gallery');
        $zeswiataTranslationEn->setSlug('global-gallery');
        $zeswiataTranslationEn->setLang('en');
        $zeswiataTranslationEn->setContent('This is a test content for global gallery');
        $zeswiataTranslationEn->setCategory($em->merge($this->getReference('zeswiata-gallery-cool')));

        $em->persist($zeswiataTranslation);
        $em->persist($zeswiataTranslationEn);


        $zkraju = new Category();

        $em->persist($zkraju);

        $this->addReference('zkraju-gallery-cool', $zkraju);

        $zkrajuTranslation = new CategoryTranslation();
        $zkrajuTranslation->setTitle('galeria z kraju');
        $zkrajuTranslation->setSlug('galeria-z-kraju');
        $zkrajuTranslation->setLang('pl');
        $zkrajuTranslation->setContent('To jest testowa tresc dla galerii z kraju');
        $zkrajuTranslation->setCategory($em->merge($this->getReference('zkraju-gallery-cool')));

        $zkrajuTranslationEn = new CategoryTranslation();
        $zkrajuTranslationEn->setTitle('Local gallery');
        $zkrajuTranslationEn->setSlug('local-gallery');
        $zkrajuTranslationEn->setLang('en');
        $zkrajuTranslationEn->setContent('This is a test content for local gallery');
        $zkrajuTranslationEn->setCategory($em->merge($this->getReference('zkraju-gallery-cool')));

        $em->persist($zkrajuTranslation);
        $em->persist($zkrajuTranslationEn);


        $em->flush();


        for ($j = 0; $j <= 10; $j++) {
            $gallery = new Gallery();
            // random if featured or not
            $gallery->setFeatured(rand(0, 1) == 1);

            $categories = [$zeswiata, $zkraju];
            $randCat = array_rand($categories);
            $gallery->setCategory($categories[$randCat]);

            $em->persist($gallery);

            $this->addReference('gallery'.$j, $gallery);

            $galleryTranslation = new GalleryTranslation();
            $galleryTranslation->setTitle('Testowy gallery '.$j);
            $galleryTranslation->setSlug('testowy-gallery-'.$j);
            $galleryTranslation->setLang('pl');
            $galleryTranslation->setgallery($em->merge($this->getReference('gallery'.$j)));


            $galleryTranslationEn = new GalleryTranslation();
            $galleryTranslationEn->setTitle('En test gallery '.$j);
            $galleryTranslationEn->setSlug('en-test-gallery-'.$j);
            $galleryTranslationEn->setLang('en');
            $galleryTranslationEn->setgallery($em->merge($this->getReference('gallery'.$j)));

            $plContent = '';
            $enContent = '';
            for ($i = 0; $i <= 30; $i++) {
                $plContent .= ' to jest testowa tresc galerii polska';
                $enContent .= ' this is a test en gallery content';
            }
            $galleryTranslation->setContent($plContent);
            $galleryTranslationEn->setContent($enContent);

            $em->persist($galleryTranslation);
            $em->persist($galleryTranslationEn);

            $em->flush();
        }

    }

    public function getOrder()
    {
        return 10; // the order in which fixtures will be loaded
    }
}

?>
