<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //  web
    public function index()
    {
        return response()->json(Task::all());
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

    // API 


    public function api_getCsrfToken()
    {
        return response()->json([
            'csrf_token' => csrf_token(),
        ]);
    }


    public function api_index()
    {
        try {
            $tasks = Task::orderBy('due_date', 'desc')->get();
            return response()->json($tasks, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener las tareas',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function api_create(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string',
                'due_date' => 'required|date',
            ]);

            $task = Task::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'due_date' => $validated['due_date'],
                'is_completed' => false,
            ]);

            return response()->json([
                'message' => 'Tarea creada',
                'task' => $task
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validación fallida',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear la tarea',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function api_update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->is_completed = true;
            $task->save();

            return response()->json([
                'message' => 'Tarea completada',
                'task' => $task
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tarea no encontrada'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar la tarea',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function api_destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return response()->json([
                'message' => 'Tarea eliminada'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tarea no encontrada'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar la tarea',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
