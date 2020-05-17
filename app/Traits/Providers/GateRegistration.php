<?php

namespace App\Traits\Providers;

use Gate;

trait GateRegistration
{
    /**
     * Register the application's gates.
     *
     * @return void
     */
    public function registerGates()
    {
        $this->beforeGates();

        foreach ($this->gates() as $key => $value) {
            Gate::define($key, $value);
        }

        $this->afterGates();
    }

    /**
     * Get the gates defined on the provider.
     *
     * @return array
     */
    public function gates()
    {
        return $this->gates ?? [];
    }

    /**
     * Before gate initialization event.
     *
     * @return void
     */
    public function beforeGates()
    {
        //
    }

    /**
     * After gate initialization event.
     *
     * @return void
     */
    public function afterGates()
    {
        //
    }
}
