<?php

namespace App\Providers\EventRegisters;

abstract class AbstractEventRegister
{
    protected $listen = [];

    public function listens(): array
    {
        return $this->listen;
    }
}
