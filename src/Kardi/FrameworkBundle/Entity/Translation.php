<?php

namespace Kardi\FrameworkBundle\Entity;

abstract class Translation
{
    
    public function setTranslations($translations){
        $this->translations = $translations;
    }
    
   public function trans($field){
       var_dump($this->translations);
   }
}
