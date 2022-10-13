<?php

namespace App\Actions;

use App\Actions\Contracts\ActionAbleContract;
use App\Notifications\YourRegistrationIsCompleteNotification;

class SendNotificationAction implements ActionAbleContract
{

    public function handle(array $data, ?\Closure $closure = null)
    {
        $data['user']->notify(new YourRegistrationIsCompleteNotification($data['user']));

        $is_sent = true;

        $data['is_sent'] = $is_sent;

        return $closure ? $closure($data) : $is_sent;
    }
}
