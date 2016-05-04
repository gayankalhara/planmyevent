<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//For Notifications
use Vinkla\Pusher\Facades\Pusher;
use App\Notifications;

class NotificationController extends Controller
{
    /**
     * Show Notification
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowNotification(Request $request)
    {

        $newNotification = new Notifications();

        $newNotification->title = $request->input('title');
        $newNotification->body = $request->input('message');
        $newNotification->icon = $request->input('icon');
        $newNotification->link = $request->input('link');
        $newNotification->readStatus = '0';
        $newNotification->save();

        $message = $request->input('message');
        $icon = $request->input('icon');
        $link = $request->input('link');
        $title = $request->input('title');

        Pusher::trigger('notifications', 'success_notification', ['message' => $message, 'icon' => $icon, 'link' => $icon, 'title' => $title]);

        //return $request->input('message');
    }

    public function setStatus()
    {
        Notifications::where('readStatus', '=', '0')
            ->update(['readStatus' => 1]);
    }
}
