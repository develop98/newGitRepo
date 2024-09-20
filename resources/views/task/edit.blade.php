<!-- resources/views/task/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="parent_task_id">Parent Task:</label>
            <select id="parent_task_id" name="parent_task_id" class="form-control">
                <option value="">None</option>
                @foreach($parentTasks as $parentTask)
                    <option value="{{ $parentTask->id }}" {{ $task->parent_task_id == $parentTask->id ? 'selected' : '' }}>{{ $parentTask->title }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
