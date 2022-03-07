<?php

namespace App\Listeners\Review;

use App\Events\Review\reviewCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reviewCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Review\reviewCreated  $event
     * @return void
     */
    public function handle(reviewCreated $event)
    {
        //
    }
}
