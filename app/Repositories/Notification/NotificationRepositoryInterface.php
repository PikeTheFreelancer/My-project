<?php

namespace App\Repositories\Notification;

interface NotificationRepositoryInterface {
    public function notiFromMerchandise($request);
    public function notiFromNewsfeed($request);
}