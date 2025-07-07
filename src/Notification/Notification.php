<?php

namespace App\Notification;

use App\Notification\ValueObject\NotificationObject;

class Notification
{
    public const ALL = 'ALL';
    public const WARNING = 'WARNING';
    public const INFOMATION = 'INFOMATION';
    public const ERROR = 'ERROR';
    public const SUCCESS = 'SUCCESS';

    public function __construct(string $type, string $message)
    {
        if(!isset($_SESSION)) {
            session_start();
        }

        $id = uniqid();

        $_SESSION['flash'][$id] = new NotificationObject($id, $type , $message);
    }
}
