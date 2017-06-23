<?php

namespace Kardi\PageBundle\Service;

use Kardi\PageBundle\Entity\Page;
use Kardi\PageBundle\Entity\PageTranslation;

class PageService
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
     * @return page
     */
    public function createEmptypageWithTranslations()
    {
        $page = new Page();

        foreach ($this->languages as $language) {
            $translation = new PageTranslation();
            $translation->setLang($language);
            $translation->setPage($page);
            $page->getTranslations()->add($translation);
        }

        return $page;
    }
}
