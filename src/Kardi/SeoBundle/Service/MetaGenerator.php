<?php

namespace Kardi\SeoBundle\Service;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\Translator;

class MetaGenerator
{

    /**
     * @var ContainerInterface
     */
    private $serviceContainer;
    /**
     * @var Translator
     */
    private $translator;

    public function __construct(ContainerInterface $serviceContainer, Translator $translator)
    {
        $this->serviceContainer = $serviceContainer;
        $this->translator = $translator;
    }

    /**
     * Any object like news, category etc
     * @param $objectOrString
     * @return string
     */
    public function generateMetaTitleFromObject($objectOrString)
    {
        if (method_exists($objectOrString, 'trans')) {
            return $objectOrString->trans('title') . ' - ' . $this->getDefaultMetaTitle();
        }

        if (is_string($objectOrString)) {
            return $this->translator->trans($objectOrString);
        }

        return '';
    }

    /**
     * Any object like news, category etc
     * @param $objectOrString
     * @return string
     */
    public function generateMetaDescriptionFromObject($objectOrString)
    {
        if (method_exists($objectOrString, 'trans')) {
            try {
                return $objectOrString->trans('description');
            } catch (Exception $e) {

            }
        }

        if (is_string($objectOrString)) {
            return $this->translator->trans($objectOrString);
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDefaultMetaTitle()
    {
        return $this->serviceContainer->getParameter('meta_title');
    }
}
