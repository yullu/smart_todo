<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Task statistics
        $total = Task::where('user_id', $userId)->count();
        $completed = Task::where('user_id', $userId)->where('status', 'Completed')->count();
        $pending = Task::where('user_id', $userId)->where('status', 'Pending')->count();

        // Priority statistics
        $priority_low = Task::where('user_id', $userId)->where('priority', 'Low')->count();
        $priority_medium = Task::where('user_id', $userId)->where('priority', 'Medium')->count();
        $priority_high = Task::where('user_id', $userId)->where('priority', 'High')->count();


        return view('dashboard.dashboard', compact(
            'total',
            'completed',
            'pending',
            'priority_low',
            'priority_medium',
            'priority_high'
        ));
    }
}
