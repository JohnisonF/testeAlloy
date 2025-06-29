<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return response()->json($tasks);
    }

    public function show($id)
    {
        $task = $this->taskService->getTaskById($id);
        return response()->json($task);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'        => 'required|string|max:255',
            'descricao'   => 'nullable|string',
            'finalizado'  => 'boolean',
            'data_limite' => 'nullable|date',
        ]);

        $task = $this->taskService->createTask($data);
        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nome'        => 'sometimes|required|string|max:255',
            'descricao'   => 'nullable|string',
            'finalizado'  => 'boolean',
            'data_limite' => 'nullable|date',
        ]);

        $task = $this->taskService->updateTask($id, $data);
        return response()->json($task);
    }

    public function destroy($id)
    {
        $this->taskService->deleteTask($id);
        return response()->json(['message' => 'Task removida com sucesso.']);
    }

    public function toggle($id)
    {
        $task = $this->taskService->toggleTask($id);
        return response()->json([
            'message' => 'Task alterada com sucesso.',
            'task' => $task
        ]);
    }
}
