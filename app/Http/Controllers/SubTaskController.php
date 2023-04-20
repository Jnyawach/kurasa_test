<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubTaskController extends Controller
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
    public function store(Request $request)
    {
        //
        $validated=$request->validate([
            'due_date'=>'required|date',
            'start_time'=>'required|date',
            'team_member'=>'required|integer',
            'task_id'=>'required|integer'
        ]);

        $sub_task=UserTask::create([
            'due_date'=>Carbon::parse($validated['due_date']),
            'status_id'=>2,
            'user_id'=>$validated['team_member'],
            'task_id'=>$validated['task_id'],
            'start_time'=>Carbon::parse($validated['start_time'])
        ]);

        return redirect()->back()
            ->with('status','Sub task successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $task=UserTask::findOrFail($id);

        $task->forceDelete();
        return redirect()->back()
            ->with('status','Sub-task successfully deleted');
    }

    public function cancelTask($id){
        $task=UserTask::findOrFail($id);
        $task->update([
            'status_id'=>4
        ]);
        return redirect()->back()
            ->with('status','The sub-task has been cancelled');
    }

    public function completeTask(Request $request,$id){
        $validated=$request->validate([
            'remarks'=>'string|max:255|required'
        ]);
        $task=UserTask::findOrFail($id);
        $task->update([
            'status_id'=>3,
            'remarks'=>$validated['remarks'],
            'end_time'=>Carbon::now()
        ]);
        return redirect()->back()
            ->with('status','The sub-task has been marked complete');
    }

    public function trashTask($id){

        $task=UserTask::findOrFail($id);
        $task->delete();
        return redirect()->back()
            ->with('status','The sub-task has been marked complete');
    }
}
