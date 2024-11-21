<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Jobs\NewUserNotifyAdminJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewUserMailToAdmin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewUserRegistered $event): void
    {

        NewUserNotifyAdminJob::dispatch($event->user);
    }
}
