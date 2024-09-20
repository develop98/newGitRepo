<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Management Dashboard</h1>

    <!-- Button to Create Task -->
    <div class="mb-4">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks Here</h5>
                    <p class="card-text">Total: {{ $pendingTasks->count() }}</p> <!-- Display task count -->
                    <hr style="border: 1px solid black;">
                    @foreach($pendingTasks as $index => $task)
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $index + 1 }}. {{ $task->title }}</h6> <!-- Add numbering -->
                            <div>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" action="{{ route('tasks.delete', $task->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @if($task->subtasks->count())
                                    <ul>
                                        @foreach($task->subtasks as $subtask)
                                            <li>{{ $subtask->title }} - <a href="{{ route('tasks.edit', $subtask->id) }}" class="btn btn-warning btn-sm">Edit</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks Here</h5>
                    <p class="card-text">Total: {{ $completedTasks->count() }}</p>
                    <hr style="border: 1px solid black;">
                    @foreach($completedTasks as $index => $task)
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $index + 1 }}. {{ $task->title }}</h6> <!-- Add numbering -->
                            <div>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" action="{{ route('tasks.delete', $task->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @if($task->subtasks->count())
                                    <ul>
                                        @foreach($task->subtasks as $subtask)
                                            <li>{{ $subtask->title }} - <a href="{{ route('tasks.edit', $subtask->id) }}" class="btn btn-warning btn-sm">Edit</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Overdue Tasks Here</h5>
                    <p class="card-text">Total: {{ $overdueTasks->count() }}</p>
                    <hr style="border: 1px solid black;">
                    @foreach($overdueTasks as $index => $task)
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $index + 1 }}. {{ $task->title }}</h6> <!-- Add numbering -->
                            <div>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" action="{{ route('tasks.delete', $task->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @if($task->subtasks->count())
                                    <ul>
                                        @foreach($task->subtasks as $subtask)
                                            <li>{{ $subtask->title }} - <a href="{{ route('tasks.edit', $subtask->id) }}" class="btn btn-warning btn-sm">Edit</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
