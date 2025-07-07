<?php

namespace App\Notification;

use App\Notification\ValueObject\NotificationObject;

class NotificationManager
{
    public static function dispatchAll(): string
    {
        if(!isset($_SESSION)) {
            session_start();
        }

        if (!$notifications = ($_SESSION['flash'] ?? null)) {
            return '';
        }

        $content = '';

        foreach ($notifications as $id => $notification) {
            $content .= self::dispatch($notification);
        }

        return $content;
    }


    private static function dispatch(NotificationObject $notification): string
    {
        ob_start();
        require TEMPLATES_ROOT.'/'.$_ENV['NOTIFICATION_TEMPLATE'];
        $content = ob_get_contents();
        ob_clean();

        unset($_SESSION['flash'][$notification->id]);

        return $content;
    }
}
