<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Role;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class AssignRole
 * @package App\Listeners
 */
class AssignRole
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered $event
     *
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $event->_user->attachRole($event->_role);
    }
}
