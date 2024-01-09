<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TasksRequest;
use App\Http\Requests\UpdateTaskRequest;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();

        if ($request->ajax()) {
            $data = Task::orderByRaw("CASE WHEN priority = 'High' THEN 0 ELSE 1 END")
                ->orderBy('priority', 'asc')
                ->latest()
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editTask"><em class="icon ni ni-edit" style="color:dark;font-size:15px;padding-right:2px"></em></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="deleteTask" onclick="deleteTask("' . $row->id . '")"><em class="icon ni ni-trash" style="color:red;font-size:15px"></em></a>';

                    return $btn;
                })
                ->make(true);
        }

        return view('tasks.tasks', compact('tasks'));
    }


    public function create()
    {
        return view('tasks.tasks_form');
    }

    public function store(TasksRequest $request)
    {
        $validatedData = $request->validated();

        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->priority = $validatedData['priority'];
        $task->due_date = $validatedData['due_date'];
        $task->completed = isset($request['completed']) ? 1 : 0;
        $task->save();

        return response()->json([
            'message' => 'Task has been created.'
        ], JsonResponse::HTTP_OK);
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.tasks_form', compact('task'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $validatedData = $request->validated();
        $task = Task::find($id);
        if ($task) {
            $data = [
                'user_id' => auth()->user()->id,
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'priority' =>  $validatedData['priority'],
                'due_date' =>  $validatedData['due_date'],
                'completed' => isset($request['completed']) ? 1 : 0
            ];
        }
        $task->update($data);

        return response()->json([
            'message' => 'Task has been updated.'
        ], JsonResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        Task::where('id', $id)->delete();

        return response()->json([
            'success' => 'Task deleted successfully.'
        ], JsonResponse::HTTP_OK);
    }
}
