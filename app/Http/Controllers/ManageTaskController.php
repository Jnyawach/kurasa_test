<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserTaskResource;
use App\Models\Status;
use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManageTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request)
    {
        //

       // return $request->all();

        $task=Task::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'due_date'=>Carbon::parse($request->due_date),
            'status_id'=>1
        ]);

        if ($request->assign){
            $task->tasks()->create([
                'user_id'=>$request->team_member,
                'due_date'=>Carbon::parse($request->due_date),
                'status_id'=>2,
                'start_time'=>Carbon::now()
            ]);
            $task->update([
                'status'=>2
            ]);

        }

        return redirect()->back()
            ->with('status','Task created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $search=request('search');

        $task=new TaskResource(Task::findOrFail($id));
        $sub_tasks=UserTaskResource::collection(UserTask::query()

            ->when(request('status'), function ($query, $status){
                $query->where('status_id', $status);
            })
            ->with(['user'=>function($query) use($search){
                $query->where('name', 'like', "%{$search}%");
            }])
            ->where('task_id',$id)->paginate(request('showing')));
        $filters=request()->only(['search','showing','status','due_date']);
        $statuses=Status::select('name','id')->get();
        return inertia::render('sub-tasks', compact('task', 'sub_tasks','statuses','filters'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task=Task::findOrFail($id);

        $task->forceDelete();
        return redirect()->back()
            ->with('status','Tasks successfully deleted');
    }

    public function cancelTask($id){
        $task=Task::findOrFail($id);
        $task->update([
            'status_id'=>4
        ]);
        return redirect()->back()
            ->with('status','The task has been cancelled');
    }

    public function completeTask($id){

        $task=Task::findOrFail($id);
        $task->update([
            'status_id'=>3
        ]);
        return redirect()->back()
            ->with('status','The task has been marked complete');
    }

    public function trashTask($id){

        $task=Task::findOrFail($id);
        $task->delete();
        return redirect()->back()
            ->with('status','The task has been marked complete');
    }


}
