<?php

namespace Kardi\AdminBundle\Helper;


class Date
{
    /**
     * @param string $date
     * @param string $inputFormat
     * @param string $outputFormat
     * @return string
     */
    public static function transform(string $date, $inputFormat = 'd/m/Y', $outputFormat = 'Y-m-d H:i:s'): string
    {
        $dateTime = \DateTime::createFromFormat($inputFormat,$date);

        return $dateTime->format($outputFormat);
    }

    /**
     * @param string $date
     * @param string $format
     * @return bool
     */
    public static function validateDate(string $date, $format = 'd/m/Y'): bool
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
