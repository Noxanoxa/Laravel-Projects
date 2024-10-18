<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class NotificationsController extends Controller
{

    public function getNotifications()
    {
        return [
            'read'      => auth()->user()->readNotifications,
            'unread'    => auth()->user()->unreadNotifications,
            'usertype'  => auth()->user()->roles->first()->name,
        ];
    }

    public function markAsRead(Request $request)
    {
        return auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }

/*    public function markAsReadAndRedirect($id)
    {
        $notification = auth()->user()->notifications->where('id', $id)->first();
        $notification->markAsRead();

        if (auth()->user()->roles->first()->name == 'user') {

            if ($notification->type == 'App\Notifications\NewCommentForPostOwnerNotify') {
                return redirect()->route('users.comment.edit', $notification->data['id']);
            } else {
                return redirect()->back();
            }
        }

    }*/



}
