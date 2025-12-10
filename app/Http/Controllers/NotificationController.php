<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->route('tasks')->with('success', 'All notifications read successfully.');
    }
}
