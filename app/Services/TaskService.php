<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class TaskService
{
    public function getAllTasks()
    {
        return Cache::tags(['tasks'])->remember('tasks.all', 60, function () {
            return Task::all();
        });
    }

    public function getTaskById($id)
    {
        return Cache::tags(['tasks'])->remember("tasks.{$id}", 60, function () use ($id) {
            return Task::findOrFail($id);
        });
    }

    public function createTask($data)
    {
        $task = Task::create($data);
        Cache::tags(['tasks'])->flush();
        return $task;
    }

    public function updateTask($id, $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        Cache::tags(['tasks'])->flush();
        return $task;
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        Cache::tags(['tasks'])->flush();
        return true;
    }

    public function toggleTask($id)
    {
        $task = Task::findOrFail($id);
        $task->finalizado = !$task->finalizado;
        $task->save();
        Cache::tags(['tasks'])->flush();
        return $task;
    }

}