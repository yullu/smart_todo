@extends('layout.app')
@section('content')
    <div class="container">
        <h2 class="mb-3">My Tasks</h2>
        <hr>
        <form method="GET" action="{{ route('tasks') }}" class="row g-2 mb-4">

            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control" placeholder="Search tasks...">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Filter by Status</option>
                    <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
                    <option value="Completed" {{ request('status')=='Completed'?'selected':'' }}>Completed</option>
                </select>
            </div>

            <div class="col-md-2">
                <select name="priority" class="form-select">
                    <option value="">Priority</option>
                    <option value="High" {{ request('priority')=='High'?'selected':'' }}>High</option>
                    <option value="Medium" {{ request('priority')=='Medium'?'selected':'' }}>Medium</option>
                    <option value="Low" {{ request('priority')=='Low'?'selected':'' }}>Low</option>
                </select>
            </div>

            <div class="col-md-1">
                <div class="form-check mt-2">
                    <input type="checkbox" name="today" value="1" class="form-check-input"
                        {{ request('today') ? 'checked' : '' }}>
                    <label class="form-check-label">Today</label>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100"><i class="bi bi-arrow-bar-right"></i> Apply</button>
            </div>
        </form>
        <hr>
        <a href="{{ url('tasks/create') }}" class="btn btn-primary mb-3">+ New Task</a>
        @include('_message')

        @foreach ($tasks as $task)
            <div class="card mb-2 {{ $task->status == 'Completed' ? 'border-success' : '' }}">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{ $task->title }}</h5>
                        <p>{{ $task->description }}</p>
                        <span class="badge bg-{{ $task->priority == 'High' ? 'danger' : ($task->priority == 'Medium' ? 'warning' : 'secondary') }}">
                        {{ $task->priority }}
                    </span>
                        <small class="text-muted">Due: {{ $task->due_date ?? 'N/A' }}</small>
                        <p>
                            <i>
                            <span class="badge bg-{{ $task->status == 'Pending' ? 'warning' : ($task->status == 'Completed' ? 'success' : 'secondary') }}">
                                Status: {{ $task->status }}
                            </i>
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('tasks/edit/'.$task->id) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a href="{{ url('tasks/destroy/'.$task->id) }}" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash2"></i> Delete</a>
                        @if ($task->status == 'Pending')
                            <a href="{{ url('tasks/complete/'.$task->id) }}" class="btn btn-sm btn-outline-success"><i class="bi bi-check2-square"></i> Mark Complete</a>
                        @else
                                <a href="{{ url('tasks/incomplete/'.$task->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-exclamation-square"></i> Mark Pending</a>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach

        {{ $tasks->links('pagination::bootstrap-5') }}
    </div>
@endsection
