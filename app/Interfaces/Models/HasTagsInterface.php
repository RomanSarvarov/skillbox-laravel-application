<?php

namespace App\Interfaces\Models;

interface HasTagsInterface
{
    public function syncTags(array $tags): bool;
}
