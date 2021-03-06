<?php

namespace App\Providers;

use App\Gates\TestGate;
use App\Models\User;
use App\Traits\Providers\GateRegistration;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use GateRegistration;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        /* Политики в app/Models/Politics инициализируются автоматически */
    ];

    /**
     * The gate mappings for the application.
     *
     * @var array
     */
    protected $gates = [
        'test' => TestGate::class,
        /*'show-post' => PostGate::class . '@update',
        'update-post' => PostGate::class . '@update',*/
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();
    }

    /**
     * Before gate initialization event.
     *
     * @return void
     */
    public function beforeGates()
    {
        Gate::before(fn(User $user) => $user->is_admin ? true : null);
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
