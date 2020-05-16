<?php

namespace App\Contracts\Models;

interface HasUrl
{
    public function getUrlAttribute(): string;
}
