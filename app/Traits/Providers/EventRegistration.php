<?php

namespace App\Traits\Providers;

use App\Contracts\Providers\EventRegister;
use Event;

trait EventRegistration
{
    /**
     * Возвращает массив регистраторов событий.
     *
     * @return array
     */
    public function registers()
    {
        return $this->registers ?? [];
    }

    /**
     * Регестрирует события и слушатели.
     *
     * @return void
     */
    public function registerEvents()
    {
        $eventRegisters = $this->registers();

        if (!$eventRegisters) {
            return;
        }

        foreach ($eventRegisters as $eventRegisterClass) {
            /** @var EventRegister $eventRegister */
            $eventRegister = new $eventRegisterClass();

            if (!$events = $eventRegister->listens()) {
                continue;
            }

            foreach ($events as $event => $listeners) {
                foreach (array_unique($listeners) as $listener) {
                    Event::listen($event, $listener);
                }
            }
        }
    }
}
