<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Idea;
use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Auth\User;
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
        User::class => ProfilePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin' ,function (User $user) : bool {
            return (bool) $user->is_admin;
        });
        //you can use this gate in many ways
        // you can use it like this
        // if(Gate::allows('admin'))
        // or you can use it as well
        // $this->authorize('admin')
        Gate::define('idea.delete' ,function (User $user , Idea $idea) : bool {
            return (bool) ($user->is_admin || $idea->user_id == $user->id);
        });

        Gate::define('idea.edit' ,function (User $user, Idea $idea) : bool {
            return (bool) ($idea->user_id == $user->id);
        });

        Gate::define('comment.edit' ,function (User $user, Comment $c) : bool {
            return (bool) ($c->user_id == $user->id);
        });
        Gate::define('comment.delete' ,function (User $user, Comment $c) : bool {
            return (bool) ($user->is_admin || $c->user_id == $user->id);
        });
    }
}
