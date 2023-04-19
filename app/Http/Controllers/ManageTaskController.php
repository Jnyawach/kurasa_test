<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
                'status_id'=>2
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
    }
}
