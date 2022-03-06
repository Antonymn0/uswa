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
        'App\Events\User\tutorAccountApproved' => [
            'App\Listeners\User\tutorAccountApprovedListener',
        ],
        'App\Events\User\tutorAccountDeclined' => [
            'App\Listeners\User\tutorAccountDeclinedListener',
        ],


        // email verification  events
        'App\Events\EmailVerification\SendEmailVerificationLink' => [
            'App\Listeners\EmailVerification\SendEmailVerificationLinkListener',
        ],

        // Lesson events
        'App\Events\Lesson\lessonCreated' => [
            'App\Listeners\Lesson\lessonCreatedListener',
        ],
        'App\Events\Lesson\lessonUpdated' => [
            'App\Listeners\Lesson\lessonUpdatedListener',
        ],
        'App\Events\Lesson\lessonDestroyed' => [
            'App\Listeners\Lesson\lessonDestroyedListener',
        ],
        
        // TrialLesson events
        'App\Events\TrialLesson\trialLessonCreated' => [
            'App\Listeners\TrialLesson\trialLessonCreatedListener',
        ],
        'App\Events\TrialLesson\trialLessonUpdated' => [
            'App\Listeners\TrialLesson\trialLessonUpdatedListener',
        ],
        'App\Events\TrialLesson\trialLessonDestroyed' => [
            'App\Listeners\TrialLesson\trialLessonDestroyedListener',
        ],
        'App\Events\TrialLesson\trialLessonAccepted' => [
            'App\Listeners\TrialLesson\trialLessonAcceptedListener',
        ],
        'App\Events\TrialLesson\trialLessonDeclined' => [
            'App\Listeners\TrialLesson\trialLessonDeclinedListener',
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
