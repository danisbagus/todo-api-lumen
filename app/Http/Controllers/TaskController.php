<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getList(){

        $tasks = Task::all();

        return response()->json([
            'success' => true,
            'message' => 'Success to get list of tasks',
            'data' => $tasks,
        ], 200);
    }

    public function getDetail($id){

        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
                'data' => '',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success to get detail of task',
            'data' => $task,
        ], 200);
    }

    public function create(Request $request){

        $name = $request->input('name');
        $userId = $request->input('user_id');

        $task = Task::create([
            'name' => $name,
            'user_id' => $userId
        ]);

        if(!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create new task',
                'data' => '',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task has been created',
            'data' => $task,
        ], 200);
    }

    public function update($id, Request $request){

        $name = $request->input('name');
        $userId = $request->input('user_id');

        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
                'data' => '',
            ], 400);
        }

        $task->update([
            'name' => $name,
            'user_id' => $userId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task has been updated',
            'data' => $task,
        ], 200);
    }

    public function delete($id){

        $task = Task::find($id);

        if(!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
                'data' => '',
            ], 400);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task has been deleted',
            'data' => ''
        ], 200);
    }

}
