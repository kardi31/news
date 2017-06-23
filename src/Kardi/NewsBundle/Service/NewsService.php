<?php

namespace Kardi\NewsBundle\Service;

use Kardi\NewsBundle\Entity\News;
use Kardi\NewsBundle\Entity\NewsTranslation;

class NewsService
{
    /**
     * @var array
     */
    private $languages;

    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return News
     */
    public function createEmptyNewsWithTranslations()
    {
        $news = new News();

        foreach ($this->languages as $language) {
            $translation = new NewsTranslation();
            $translation->setLang($language);
            $translation->setNews($news);
            $news->getTranslations()->add($translation);
        }

        return $news;
    }
}
