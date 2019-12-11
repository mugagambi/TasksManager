<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Add the auth middleware for all the resources in this controller
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the list of tasks
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tasks = Task::where(['user_id' => Auth::user()->id])->get();
        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    /**
     * Store the created task
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $task = Task::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id
        ]);

        return response()->json([
            'task' => $task,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Update a given task
     *
     * @param Request $request
     * @param Task $task
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->save();

        return response()->json([
            'message' => 'Task updated successfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
