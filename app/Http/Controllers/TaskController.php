<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Http\Resources\UserTaskResource;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks=TaskResource::collection(
            Task::query()
                ->when(request('search'), function ($query, $search){
                    $query->where('name', 'like', "%{$search}%");
                })
                ->when(request('status'), function ($query, $status){
                    $query->where('status_id', $status);
                })
          ->paginate(request('showing'))
        );

        $filters=request()->only(['search','showing','status','due_date']);
        $statuses=Status::select('name','id')->get();
        return inertia::render('welcome', compact('tasks', 'filters', 'statuses'));
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

    public function getMembers(){
        return User::select('id','name')->get();
    }

}
