<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskReminderNotification extends Notification
{
    use Queueable;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database']; // save into DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Task Reminder',
            'message' => 'Your task "' . $this->task->title . '" is due soon.',
            'task_id' => $this->task->id,
        ];
    }
}
