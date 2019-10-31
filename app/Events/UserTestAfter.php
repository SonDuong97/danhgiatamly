<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class UserTestAfter
 * @package App\Events
 */
class UserTestAfter
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $_result;

    /**
     * @var
     */
    public $_questionType;

    /**
     * @var User
     */
    public $_user;

    /**
     * UserTestAfter constructor.
     *
     * @param User $user
     * @param $result
     * @param $questionType
     */
    public function __construct(User $user, $result, $questionType)
    {
        $this->_user         = $user;
        $this->_result       = $result;
        $this->_questionType = $questionType;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
