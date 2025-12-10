📌 Smart Todo – Laravel 12 Task Manager

A clean, simple, and powerful Task Management System built with Laravel 12 and Bootstrap 5.
Smart Todo lets users create tasks, set priorities, receive reminders, get notifications, and manage productivity—all inside a minimal, user-friendly interface.

🚀 Features
📝 Task Management

Create, edit, update, delete tasks

Mark tasks as Completed / Pending

Task priorities (High / Medium / Low)

Due date + Reminder date (reminder_at)

Pagination included

🔎 Search & Filters

Search by title or description

Filter tasks by:

Completed

Pending

High Priority

Today’s tasks

🔔 Notifications System

Laravel Database Notifications

Bell icon in navbar with unread count

Dropdown list of notifications

“Mark all as read” feature

Each notification links to its task

Reminder notifications triggered automatically

🌙 Dark Mode

Dark/Light theme toggle

Saved to user preference using Bootstrap classes

🔐 User Authentication + Roles

Laravel Breeze authentication

Added role_id on users table

Simple RBAC:

Admin (role_id = 1)

User (role_id = 2)

Role-based access using custom middleware

⏰ Task Reminder Scheduler

Automatic reminders using Laravel Scheduler:

Checks tasks where:

reminder_at <= now()

reminder_sent = false

Sends a notification

Marks reminder as sent

🏗️ Tech Stack

Laravel 12

Bootstrap 5

MySQL

Laravel Breeze

Chart.js (optional)

Laravel Notifications

Scheduler / Cron

⚙️ Installation
Clone the repository
git clone https://github.com/yullu/smart_todo.git
cd smart_todo

Install dependencies
composer install
npm install
npm run build

Environment setup
cp .env.example .env
php artisan key:generate

Update .env with your database details.

Run migrations
php artisan migrate

Start application
php artisan serve

📬 Running the Reminder Scheduler
Temporarily (testing)
php artisan schedule:work

Permanently (Linux cronjob)

Run:

crontab -e


Add:

* * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1


🤝 Contribution

Pull requests are welcome!
Feel free to open issues for suggestions or improvements.

📝 License

This project is open-source under the MIT License.
