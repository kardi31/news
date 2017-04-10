<?php

namespace Kardi\FrameworkBundle\Twig;

class TextExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('truncate', [$this, 'truncateText']),
        ];
    }

    /**
     * @return string
     */
    public function truncateText($text, $length = 60, $type = 'letters', $endText = '...')
    {
        if ($type == 'words') {
            return $this->shorten_string($text, $length, $endText);
        } else {
            return substr($text,0,$length).$endText;
        }
    }

    /**
     * @param $string
     * @param $wordsreturned
     * @return string
     */
    private function shorten_string($string, $wordsreturned, $endText = '')
    {
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);
        if (count($array) <= $wordsreturned) {
            $retval = $string;
        } else {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array) . " ".$endText;
        }
        return $retval;
    }
}
