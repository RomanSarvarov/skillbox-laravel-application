<?php

namespace App\Providers\EventRegisters;

use App\Contracts\Providers\EventRegister;

abstract class AbstractEventRegister implements EventRegister
{
    protected $listen = [];

    public function listens(): array
    {
        return $this->listen;
    }
}
