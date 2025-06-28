<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = $request->user()->todos()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'todos' => $todos
        ]);
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->user()->todos()->create([
            'title' => $request->title,
            'is_completed' => $request->is_completed ?? false,
        ]);

        return response()->json([
            'todo' => $todo,
            'message' => 'Todo created successfully'
        ], 201);
    }

    public function update(TodoRequest $request,  $id)
    {

        $todo = Todo::findOrFail($id);
        if ($todo->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        $todo->update($request->only(['title', 'is_completed']));

        return response()->json([
            'todo' => $todo,
            'message' => 'Todo updated successfully'
        ]);
    }

    public function destroy(Request $request,  $id)
    {
        $todo = Todo::findOrFail($id);
        if ($todo->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted successfully'
        ]);
    }
}
