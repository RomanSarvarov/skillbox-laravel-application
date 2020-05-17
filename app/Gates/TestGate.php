<?php

namespace App\Gates;

use App\Models\User;

class TestGate
{
    public function __invoke(User $user): bool
    {
        return true;
    }
}
