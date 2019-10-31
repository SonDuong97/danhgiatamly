<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Profile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CreateProfile
 * @package App\Listeners
 */
class CreateProfile
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
        $profile              = new Profile();
        $profile->user_id     = $event->_user->id;
        $profile->avatar_path = 'upload/avatar/default.png';
        $profile->save();
    }
}
