<?php

namespace App\Notification\ValueObject;

class NotificationObject
{
    public function __construct(
        public string $id,
        public string $type,
        public string $message,
    ) {
    }
}
