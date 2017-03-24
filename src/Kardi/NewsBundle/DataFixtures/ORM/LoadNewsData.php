<?php
namespace Kardi\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\NewsBundle\Entity\News;
use Kardi\NewsBundle\Entity\Category;
use Kardi\NewsBundle\Entity\CategoryTranslation;
use Kardi\NewsBundle\Entity\NewsTranslation;

class LoadNewsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $zeswiata = new Category();

        $em->persist($zeswiata);

        $this->addReference('zeswiata-news-cool', $zeswiata);

        $zeswiataTranslation = new CategoryTranslation();
        $zeswiataTranslation->setTitle('Wiadomosci ze swiata');
        $zeswiataTranslation->setSlug('wiadomosci-ze-swiata');
        $zeswiataTranslation->setLang('pl');
        $zeswiataTranslation->setContent('To jest testowa tresc dla wiadomosci ze swiata');
        $zeswiataTranslation->setCategory($em->merge($this->getReference('zeswiata-news-cool')));

        $zeswiataTranslationEn = new CategoryTranslation();
        $zeswiataTranslationEn->setTitle('Global news');
        $zeswiataTranslationEn->setSlug('global-news');
        $zeswiataTranslationEn->setLang('en');
        $zeswiataTranslationEn->setContent('This is a test content for global news');
        $zeswiataTranslationEn->setCategory($em->merge($this->getReference('zeswiata-news-cool')));

        $em->persist($zeswiataTranslation);
        $em->persist($zeswiataTranslationEn);


        $zkraju = new Category();

        $em->persist($zkraju);

        $this->addReference('zkraju-news-cool', $zkraju);

        $zkrajuTranslation = new CategoryTranslation();
        $zkrajuTranslation->setTitle('Wiadomosci z kraju');
        $zkrajuTranslation->setSlug('wiadomosci-z-kraju');
        $zkrajuTranslation->setLang('pl');
        $zkrajuTranslation->setContent('To jest testowa tresc dla wiadomosci z kraju');
        $zkrajuTranslation->setCategory($em->merge($this->getReference('zkraju-news-cool')));

        $zkrajuTranslationEn = new CategoryTranslation();
        $zkrajuTranslationEn->setTitle('Local news');
        $zkrajuTranslationEn->setSlug('local-news');
        $zkrajuTranslationEn->setLang('en');
        $zkrajuTranslationEn->setContent('This is a test content for local news');
        $zkrajuTranslationEn->setCategory($em->merge($this->getReference('zkraju-news-cool')));

        $em->persist($zkrajuTranslation);
        $em->persist($zkrajuTranslationEn);


        $em->flush();
        
        
        for ($j = 0; $j <= 10; $j++) {
            $news = new News();
            // random if breaking or not
            $news->setBreakingNews(rand(0, 1) == 1);

            $categories = [$zeswiata, $zkraju];
            $randCat = array_rand($categories);
            $news->setCategory($categories[$randCat]);
            $news->setAuthor('John Doe '.$j);

            $em->persist($news);

            $this->addReference('news'.$j, $news);


            $news->setPhoto($em->merge($this->getReference('main-photo'.($j+10))));


            $newsTranslation = new NewsTranslation();
            $newsTranslation->setTitle('Testowy news '.$j);
            $newsTranslation->setSlug('testowy-news-'.$j);
            $newsTranslation->setLang('pl');
            $newsTranslation->setNews($em->merge($this->getReference('news'.$j)));


            $newsTranslationEn = new NewsTranslation();
            $newsTranslationEn->setTitle('En test news '.$j);
            $newsTranslationEn->setSlug('en-test-news-'.$j);
            $newsTranslationEn->setLang('en');
            $newsTranslationEn->setNews($em->merge($this->getReference('news'.$j)));

            $plContent = '';
            $enContent = '';
            for ($i = 0; $i <= 30; $i++) {
                $plContent .= ' to jest testowa tresc polska';
                $enContent .= ' this is a test en content';
            }
            $newsTranslation->setContent($plContent);
            $newsTranslationEn->setContent($enContent);

            $em->persist($newsTranslation);
            $em->persist($newsTranslationEn);

            $em->flush();
        }

    }

    public function getOrder()
    {
        return 12; // the order in which fixtures will be loaded
    }
}

?>
