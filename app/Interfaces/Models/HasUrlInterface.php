<?php

namespace App\Interfaces\Models;

interface HasUrlInterface
{
    public function getUrlAttribute(): string;
}
