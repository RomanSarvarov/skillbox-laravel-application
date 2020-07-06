<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait UserScopes
{
    public function scopeAdmins(Builder $query)
    {
        return $query->where('is_admin', true);
    }
}
