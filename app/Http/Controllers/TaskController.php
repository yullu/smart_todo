<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\TaskReminderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        // 🔍 Search by title or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('description', 'LIKE', "%{$request->search}%");
            });
        }

        // 📌 Filter tasks by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 📅 Filter today's tasks
        if ($request->filled('today') && $request->today == 1) {
            $query->whereDate('created_at', today());
        }

        // 🚨 Priority filter
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Final tasks list (same pagination you used)
        $tasks = $query->latest()->paginate(5);

        return view('tasks.index', compact('tasks'));
        //$tasks = Task::where('user_id', Auth::id())->latest()->paginate(5);
        //return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority'=>'required',
            'due_date' => 'required',
        ]);
        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->status = 'Pending';
        $task->reminder_at = $request->reminder_at;

        $task->save();
        // 🔹 Log audit trail
        activity('task')
            ->causedBy(auth()->user())
            ->performedOn($task)
            ->withProperties([
                'activated_date' => $task->title,
                'status' => $task->status,
                'ip' => $request->ip(),
            ])
            ->log('Task created');
        auth()->user()->notify(new TaskReminderNotification($task));

        return redirect()->route('tasks')->with('success', 'Task created successfully.');
    }
    public function edit($id)
    {
        $tasks = Task::find($id);
        abort_if($tasks->user_id !== Auth::id(), 403);
        return view('tasks.edit', compact('tasks'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority'=>'required',
            'due_date' => 'required',
        ]);

        $task = Task::find($id);
        abort_if($task->user_id !== Auth::id(), 403);

        $task->user_id = Auth::id();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->status = 'Pending';
        $task->reminder_at = $request->reminder_at;
        $task->update();
        // 🔹 Log audit trail
        activity('task')
            ->causedBy(auth()->user())
            ->performedOn($task)
            ->withProperties([
                'activated_date' => $task->title,
                'status' => $task->status,
                'ip' => $request->ip(),
            ])
            ->log('Task updated');
        return redirect()->route('tasks')->with('success', 'Task updated successfully.');

    }
    public function destroy($id)
    {
        $task = Task::find($id);
        abort_if($task->user_id !== Auth::id(), 403);
        $task->delete();

        // 🔹 Log audit trail
        activity('task')
            ->causedBy(auth()->user())
            ->performedOn($task)
            ->withProperties([
                'title' => $task->title,
                'ip' => request()->ip(), // <--- THIS IS THE FIX
            ])
            ->log('Task deleted');

        return redirect()->route('tasks')->with('success', 'Task deleted successfully.');
    }
    public function markComplete($id)
    {
        $task = Task::find($id);
        abort_if($task->user_id !== Auth::id(), 403);

        $task->status = 'Completed';
        $task->update();

        activity('task')
            ->causedBy(auth()->user())
            ->performedOn($task)
            ->withProperties([
                'title' => $task->title,
                'ip' => request()->ip(),
            ]);
        $user = $task->user;
        $user->notify(new TaskReminderNotification($task));

        return redirect()->route('tasks')->with('success', 'Task completed successfully.');

    }

    public function markPending($id)
    {
        $task = Task::find($id);
        abort_if($task->user_id !== Auth::id(), 403);

        $task->status = 'Pending';
        $task->update();
        activity('task')
            ->causedBy(auth()->user())
            ->performedOn($task)
            ->withProperties([
                'title' => $task->title,
                'ip' => request()->ip(),

            ]);
        return redirect()->route('tasks')->with('success', 'Task reverted to pending status.');

    }
}
