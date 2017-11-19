<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Extensions\JsonFileUserProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // in case of other types of files like xlxs, text etc, logic of reading those file goes here, if it grows too big, make seperate class
        Auth::provider('json_file_user', function ($app, array $config) {
            return new JsonFileUserProvider(json_decode(file_get_contents(base_path().'/user_provider/users.json'), true));
        });
    }
}
