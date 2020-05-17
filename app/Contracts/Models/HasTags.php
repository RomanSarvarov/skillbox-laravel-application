<?php

namespace App\Contracts\Models;

interface HasTags
{
    public function syncTagsByTagNames($tags): bool;
}
