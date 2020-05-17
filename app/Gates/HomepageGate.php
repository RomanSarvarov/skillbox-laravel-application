<?php

namespace App\Gates;

use App\Models\User;

class HomepageGate
{
    public function __invoke(User $user): bool
    {
        return true;
    }
}
