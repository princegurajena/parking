<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::query()->latest()->paginate(20);
        return view('notifications.index' , [
            'notifications' => $notifications
        ]);
    }
}
