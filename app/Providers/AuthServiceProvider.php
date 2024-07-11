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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('update-post',function($user , $post){
            return $user->id == $post->user_id ; 
        });

        Gate::define('delete-post',function($user , $post){
            return $user->id == $post->user_id ; 
        });

        Gate::before(function($user , $ability){
            // if($user->is_admin && in_array($ability,['update-post']))
            if($user->is_admin && in_array($ability,['update-post','delete-post'])){
                return true ; 
            }
        });
    }
}
