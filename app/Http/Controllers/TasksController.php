<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TasksRequest;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();

        if ($request->ajax()) {

            $data = Task::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editTask"><em class="icon ni ni-edit" style="color:dark;font-size:15px;padding-right:2px"></em></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="deleteTask" onclick="deleteTask("'.$row->id.'")"><em class="icon ni ni-trash" style="color:red;font-size:15px"></em></a>';

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

    public function store(Request $request)
    {
        // $data = $request->all();
        // Task::create($data);
        $task = new Task();
        $task->title = $request->title;
        $task->description = 'Your Description';
        $task->priority = 'high';
        $task->due_date = '2013-05-12';
        $task->completed = 0;
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

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $data = $request->all();
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
