<?php

namespace App\Interfaces\Models;

interface HasTagsInterface
{
    public function attachTags(array $tags): bool;
}
