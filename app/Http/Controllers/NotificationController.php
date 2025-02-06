<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
{
    $notification = auth()->user()->unreadNotifications()->findOrFail($id);

    $notification->markAsRead();

    $url = $notification->data['url'];

    return redirect($url);
}
}

