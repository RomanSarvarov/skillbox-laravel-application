<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use App\Traits\Providers\GateRegistration;
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
        Post::class => PostPolicy::class,
    ];

    /**
     * The gate mappings for the application.
     *
     * @var array
     */
    protected $gates = [
        /*'homepage' => HomepageGate::class,
        'show-post' => PostGate::class . '@update',
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
