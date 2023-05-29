<?php
//something about completed's route is wrong, in postman it doesn't patch
namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;

class CompleteTaskController extends Controller
{
    public function _invoke(Request $request, Task $task){
        $task->is_completed = $request-> is_completed;
        $task->save();

        return TaskResource::make($task);
    }
}
 