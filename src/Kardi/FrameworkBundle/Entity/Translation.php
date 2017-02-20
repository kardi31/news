<?php

namespace Kardi\FrameworkBundle\Entity;

abstract class Translation {

    protected $translationsArray;
    
    protected $serviceContainer;

    function __construct($serviceContainer) {
        dump($serviceContainer);
        $this->serviceContainer = $serviceContainer;
    }
    
    public function setTranslations($translations) {
        foreach ($translations as $translation) {
            $this->translationsArray[$translation->locale][] = $translation;
        }
    }

    public function trans($field) {
        dump($this->serviceContainer);
        var_dump($this->translations);
    }

}
