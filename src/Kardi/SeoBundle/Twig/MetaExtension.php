<?php

namespace Kardi\SeoBundle\Twig;

use Kardi\SeoBundle\Service\MetaGenerator;

class MetaExtension extends \Twig_Extension
{

    /**
     * @var MetaGenerator
     */
    private $metaGenerator;

    public function __construct(MetaGenerator $metaGenerator)
    {

        $this->metaGenerator = $metaGenerator;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('meta_title',[$this, 'generateMetaTitle']),
            new \Twig_SimpleFunction('meta_description',[$this, 'generateMetaDescription']),
        ];
    }

    /**
     * @param Object of different types (e.g. Category, News etc)
     * @return mixed
     */
    public function generateMetaTitle($object)
    {
        return $this->metaGenerator->generateMetaTitleFromObject($object);
    }

    /**
     * @param Object of different types (e.g. Category, News etc)
     * @return mixed
     */
    public function generateMetaDescription($object)
    {
        return $this->metaGenerator->generateMetaDescriptionFromObject($object);
    }

}
