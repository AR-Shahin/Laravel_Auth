<?php

namespace App\Listeners;

use App\Events\TeacherRegisterEvent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeacherRegisterListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(TeacherRegisterEvent $event)
    {
        if ($event->teacher instanceof MustVerifyEmail && !$event->teacher->hasVerifiedEmail()) {
            $event->teacher->sendEmailVerificationNotification();
        }
    }
}
