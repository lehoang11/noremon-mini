<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User_Profile;
use Backend;
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

        //
    view()->composer('*', function($view)
    {
        if (Auth::check()) {
            $userP = User_Profile::where('user_id', Auth::id())->first();
            $hasMenu = Backend::getAllMenuHasRole();
            $view->with('userP', $userP ? $userP :null);
            $view->with('hasMenu', $hasMenu);
        }else {
            $view->with('userP', null);
        }
    });
    }
}
