<?php

namespace App\Interfaces\Models;

use Illuminate\Support\Collection;

interface HasTagsInterface
{
    public function syncTagsByTagNames($tags): bool;
}
