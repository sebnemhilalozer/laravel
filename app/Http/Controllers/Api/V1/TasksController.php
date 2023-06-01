<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Validator;



class TasksController extends Controller
{
    public function index()
    {
        $tasks = TaskResource::collection(Task::all());
        return $tasks;

        if ($tasks->count() > 0) {

            return response()->json([
                'status' => 200,
                'tasks' => $tasks,
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'tasks' => 'No records founds about tasks!',
            ], 404);
        }
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:211',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->getMessageBag()
            ], 422);
        } else {
            return TaskResource::make($task);
        }
    }

    public function show($id)
    {
        $task = Task::find($id);
        if($task){
            return response()->json([
                'status'=> 200,
                'task'=> $task
            ],200);
        }else{
            return response()->json([
                'status'=> 200,
                'message'=> "No such task found!"
            ],404);
        }
         
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:211',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->getMessageBag()
            ], 422);
        } else {
            return TaskResource::make($task);
        }
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
