@extends('layout.app')
@section('content')
    <div class="container">
        <h2 class="mb-3">Editing Task - <i>{{ $tasks->title }}</i> </h2>
        <hr>
        <div class="col-md-8">
            <form action="{{ url('tasks/editing/'.$tasks->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Task Title --}}
                <div class="mb-3">
                    <label class="form-label">Task Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ $tasks->title }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ $tasks->description }}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Priority --}}
                <div class="mb-3">
                    <label class="form-label">Priority <span class="text-danger">*</span></label>
                    <select name="priority" class="form-select" required>
                        <option value="">--Select--</option>
                        <option value="Low" {{ old('priority', $tasks->priority ?? '') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ old('priority', $tasks->priority ?? '') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ old('priority', $tasks->priority ?? '') == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div class="mb-3">
                    <label class="form-label">Due Date</label>
                    <input type="date" name="due_date" class="form-control" value="{{ $tasks->due_date }}">
                    @error('due_date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Reminder At</label>
                    <input type="datetime-local" name="reminder_at" class="form-control"
                           value="{{ old('reminder_at', isset($task) ? $task->reminder_at : '') }}">
                </div>

                {{-- Submit Buttons --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Edit Task</button>
                </div>

            </form>
        </div>

    </div>
@endsection
