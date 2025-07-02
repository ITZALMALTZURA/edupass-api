<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /tasks
    public function index()
    {
        return response()->json(Task::all());
    }

    // POST /tasks
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return response()->json($task, 201);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect('/welcome');
    }

    // PUT /tasks/{id}
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request_update = $task->update([
            'is_completed' => true,
        ]);
        $data = [
            'request' => $request_update,
            'msg' => 'Tarea actualizada con exito'
        ];

        return response()->json($data);
    }
}
