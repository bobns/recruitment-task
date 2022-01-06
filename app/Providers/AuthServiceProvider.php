<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create', function (User $user) {
            return $user->role_id == Role::IS_ADMIN || $user->role_id == Role::IS_MODERATOR;
        });

        Gate::define('edit-posts', function (User $user, Post $post) {
            if ($user->role_id == Role::IS_ADMIN) {
                return true;
            } elseif ($user->role_id == Role::IS_MODERATOR) {
                return $post->user_id == auth()->id();
            } else {
                return false;
            }
        });

        Gate::define('edit-category', function (User $user, Category $category) {
            if ($user->role_id == Role::IS_ADMIN) {
                return true;
            } elseif ($user->role_id == Role::IS_MODERATOR) {
                return $category->created_by_user_id == auth()->id();
            } else {
                return false;
            }
        });

        Gate::define('delete', function (User $user) {
            return $user->role_id == Role::IS_ADMIN;
        });

        Gate::define('read', function (User $user) {
            return auth()->check();
        });

        //
    }
}