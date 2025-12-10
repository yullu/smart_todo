<?php

namespace App\Console\Commands;

use App\Mail\TaskReminderMail;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTaskReminders extends Command
{
    protected $signature = 'tasks:send-reminders';

    protected $description = 'Send email reminders for tasks with reminder_at time reached';

    public function handle()
    {
        $tasks = Task::whereNotNull('reminder_at')
            ->where('reminder_at', '<=', now())
            ->where('status', 'Pending')
            ->get();

        foreach ($tasks as $task) {
            Mail::to($task->user->email)->send(new TaskReminderMail($task));

            // Prevent duplicate emails
            $task->update(['reminder_at' => null]);
        }

        $this->info('Task reminders sent successfully!');
    }
}
