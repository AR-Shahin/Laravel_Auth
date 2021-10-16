<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TaskCollection(Task::latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchTask($query)
    {
        return new TaskCollection(Task::where('name', 'like', "$query%")->latest()->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'name' => $request->name
        ]);
        return $this->successResponse(new TaskResource($task), $task, 'Task', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $this->successResponse(new TaskResource($task), $task, 'Task Retrieved Successfully!', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update([
            'name' => $request->name
        ]);
        return $this->successResponse(new TaskResource($task), $task, 'Task Updated Successfully!', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->delete()) {
            return $this->successResponse([], null, 'Task Deleted Successfully!', 204);
        }
    }

    protected function successResponse($resources, $data, $mgs = null, $code = 200)
    {
        return response([
            'success' => true,
            'data' => $resources,
            'code' => $code,
            'message' => $mgs
        ], $code);
    }

    public function activeTask(Task $task)
    {
        $task->is_done = true;
        $task->save();
        return $this->successResponse(new TaskResource($task), $task, 'Task Active Successfully!', 200);
    }
    public function inactiveTask(Task $task)
    {
        $task->is_done = false;
        $task->save();
        return $this->successResponse(new TaskResource($task), $task, 'Task Inactive Successfully!', 200);
    }
}
