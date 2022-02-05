<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // user events
        'App\Events\User\userCreated' => [
            'App\Listeners\User\userCreatedListener',
        ],
        'App\Events\User\userUpdated' => [
            'App\Listeners\User\userUpdatedListener',
        ],
        'App\Events\User\userDestroyed' => [
            'App\Listeners\User\userDestroyedListener',
        ],
        // email verification  events
        'App\Events\EmailVerification\SendEmailVerificationLink' => [
            'App\Listeners\EmailVerification\SendEmailVerificationLinkListener',
        ],
        
        

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
