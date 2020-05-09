<?php

namespace App\Helpers;

use Str;

class StringHelper
{
    private function __construct()
    {

    }

    public static function doCaseAlternation(string $string, bool $isReverse): string
    {
        $formattedString = '';
        $stringArr = self::splitString($string);

        foreach ($stringArr as $key => $value) {
            $doUpper = ($key % 2 && $isReverse) || ($key % 2 === 0 && !$isReverse);

            $formattedString .= $doUpper ? Str::upper($value) : Str::lower($value);
        }

        return $formattedString;
    }

    public static function splitString(string $string): array
    {
        return preg_split('//u', $string);
    }
}
