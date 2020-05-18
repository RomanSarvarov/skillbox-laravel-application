<?php

namespace App\Contracts\Providers;

interface EventRegister
{
    public function listens(): array;
}
