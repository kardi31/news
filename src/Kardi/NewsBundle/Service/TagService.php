<?php

namespace Kardi\NewsBundle\Service;


use Kardi\NewsBundle\Entity\Tag;
use Kardi\NewsBundle\Entity\TagTranslation;

class TagService
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
     * @return Tag
     */
    public function createEmptyTagWithTranslations()
    {
        $tag = new Tag();

        foreach ($this->languages as $language) {
            $translation = new TagTranslation();
            $translation->setLang($language);
            $translation->setTag($tag);
            $tag->getTranslations()->add($translation);
        }

        return $tag;
    }
}
