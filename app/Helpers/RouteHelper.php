<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class RouteHelper
{
    public static function getNameByClassName(string $className, string $classAffix = '')
    {
        $routeName = Str::of(class_basename($className))
            ->kebab()
        ;

        $classAffixFluent = Str::of($classAffix)->trim();
        if ($classAffixFluent->isNotEmpty()) {
            $classAffixFluent = $classAffixFluent->lower();

            $routeName = $routeName
                ->replaceMatches(
                    '/' . $classAffixFluent . '$/m',
                    ''
                )
                ->rtrim('-')
            ;
        }

        $routeName = $routeName->plural();

        return $routeName;
    }
}
