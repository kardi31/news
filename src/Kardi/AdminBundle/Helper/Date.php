<?php

namespace Kardi\AdminBundle\Helper;


class Date
{
    public static function transform($date, $inputFormat = 'd/m/Y', $outputFormat = 'Y-m-d H:i:s')
    {
        $dateTime = \DateTime::createFromFormat($inputFormat,$date);
        dump($dateTime->format($outputFormat));
        return $dateTime->format($outputFormat);
    }
}
