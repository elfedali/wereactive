<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request): TaskCollection
    {
        $tasks = Task::all();

        return new TaskCollection($tasks);
    }

    public function store(TaskStoreRequest $request): TaskResource
    {
        $task = Task::create($request->validated());

        return new TaskResource($task);
    }

    public function show(Request $request, Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    public function update(TaskUpdateRequest $request, Task $task): TaskResource
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
