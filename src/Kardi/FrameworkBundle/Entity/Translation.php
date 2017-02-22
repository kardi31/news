<?php

namespace Kardi\FrameworkBundle\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

abstract class Translation {

    protected $translationsArray;

    public function setTranslations($translations) {
        foreach ($translations as $translation) {
            $this->translationsArray[$translation->getLang()] = $translation;
        }
    }

    public function trans($field) {
//        $locale = $GLOBALS['locale'] ?: 'pl';
        $locale = 'pl';

        if (isset($this->translationsArray[$locale])) {
            return call_user_func_array(array($this->translationsArray[$locale],'get'.ucwords($field)),[]);
        }

        throw new Exception('Missing translation for field '.$field);
    }

}
