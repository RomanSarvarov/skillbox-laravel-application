<?php

namespace App\Models\Concerns;

trait HasUrl
{
    public function getUrlAttribute(): string
    {
        if ($this->id === null) {
            return '';
        }

        $routeName = $this->getRouteName();

        return route("$routeName.show", $this);
    }
}
