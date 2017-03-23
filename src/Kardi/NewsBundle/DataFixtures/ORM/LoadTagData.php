<?php
namespace Kardi\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Kardi\NewsBundle\Entity\Tag;
use Kardi\NewsBundle\Entity\TagTranslation;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        for ($j = 0; $j <= 20; $j++) {
            $tag = new Tag();

            $newsArray = range(1,10);
            $rand = array_rand($newsArray,2);
            $tag->addNews($em->merge($this->getReference('news'.$rand[0])));
            $tag->addNews($em->merge($this->getReference('news'.$rand[1])));

            $em->persist($tag);

            $tagTranslationPl = new TagTranslation();
            $tagTranslationPl->setLang('pl');
            $tagTranslationPl->setTitle('tag '.$j.' pl');
            $tagTranslationPl->setSlug('tag-'.$j.'-pl');
            $tagTranslationPl->setTag($tag);

            $tagTranslationEn = new TagTranslation();
            $tagTranslationEn->setLang('en');
            $tagTranslationEn->setTitle('tag '.$j.' en');
            $tagTranslationEn->setSlug('tag-'.$j.'-en');
            $tagTranslationEn->setTag($tag);

            $em->persist($tagTranslationPl);
            $em->persist($tagTranslationEn);

            $em->flush();
        }

    }

    public function getOrder()
    {
        return 14; // the order in which fixtures will be loaded
    }
}

?>
