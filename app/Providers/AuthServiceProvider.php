<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::define('update-post',function($user , $post){
        //     return $user->id == $post->user_id ; 
        // });

        // Gate::define('delete-post',function($user , $post){
        //     return $user->id == $post->user_id ; 
        // });

        // Gate::define('update','App\Policies\BlogPostPolicy@update') ; 
        // Gate::define('delete','App\Policies\BlogPostPolicy@delete') ; 

        Gate::before(function ($user, $ability) {
            // if($user->is_admin && in_array($ability,['update-post']))
            if ($user->is_admin && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        });
    }
}
