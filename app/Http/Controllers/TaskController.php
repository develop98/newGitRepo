<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        // Fetch tasks data
        // $pendingTasks = Task::where('user_id', $userId)->where('status', 'pending')->count();
        // $completedTasks = Task::where('user_id', $userId)->where('status', 'completed')->count();
        // $overdueTasks = Task::where('user_id', $userId)->where('status', 'pending')->where('due_date', '<', now())->count();

        $pendingTasks = Task::where('user_id', $userId)->where('status', 'pending')->get();
        $completedTasks = Task::where('user_id', $userId)->where('status', 'completed')->get();
        $overdueTasks = Task::where('user_id', $userId)->where('status', 'pending')->where('due_date', '<', now())->get();

        return view('dashboard', compact('pendingTasks', 'completedTasks', 'overdueTasks'));
    }

    public function createTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'parent_task_id' => 'nullable|exists:tasks,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
            'user_id' => Auth::id(),
            'parent_task_id' => $request->parent_task_id,
        ]);

        return redirect()->route('home')->with('success', 'Task created successfully.');
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $parentTasks = Task::whereNull('parent_task_id')->get(); // Get all main tasks to select as parent
        return view('task.edit', compact('task', 'parentTasks'));
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
            'parent_task_id' => 'nullable|exists:tasks,id',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'parent_task_id' => $request->parent_task_id,
        ]);

        return redirect()->route('home')->with('success', 'Task updated successfully.');
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('home')->with('success', 'Task deleted successfully.');
    }
    
}
