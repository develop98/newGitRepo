<!-- resources/views/task/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Task</h1>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="parent_task_id">Parent Task:</label>
            <select id="parent_task_id" name="parent_task_id" class="form-control">
                <option value="">None</option>
                @foreach($parentTasks as $parentTask)
                    <option value="{{ $parentTask->id }}">{{ $parentTask->title }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection
