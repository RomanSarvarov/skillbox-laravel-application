<?php

namespace App\Models\Concerns;

trait HasUrl
{
    public function getUrlAttribute(): string
    {
        $routeName = $this->getRouteName();

        return route("$routeName.show", $this);
    }
}
