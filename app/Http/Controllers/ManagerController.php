<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
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
            'name'=>'required|string|max:50',
            'email'=>'unique:managers|required|string|email|max:80',
            'phone'=>'unique:managers|required|string|max:25',
            'supermarket_id'=>'integer|required'
        ]);


        $manager=Manager::create($validated);
        return redirect()->back()
            ->with('status','Manager saved successfully');
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

        $validated=$request->validate([
            'name'=>'required|string|max:50',
            'email'=>'required|string|email|max:80',
            'phone'=>'required|string|max:25',
            'supermarket_id'=>'integer|required'
        ]);



        $manager=Manager::findOrFail($id);
        $manager->update($validated);
        return redirect()->back()
            ->with('status','Manager saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $manager=Manager::findOrFail($id);
        $manager->delete();
        return redirect()->back()
            ->with('status','Manager successfully deleted');
    }
}
