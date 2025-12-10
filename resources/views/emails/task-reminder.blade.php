<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif;">

<h2>🔔 Task Reminder</h2>

<p>Hello {{ $task->user->name }},</p>

<p>This is a reminder for your task:</p>

<h3>{{ $task->title }}</h3>

<p>{{ $task->description }}</p>

<p><strong>Due Date:</strong> {{ $task->due_date }}</p>

<p>Please remember to complete your task.</p>

<br>

<p>Smart To-Do Manager</p>

</body>
</html>
