<?php

namespace App\Http\Controllers;

use App\Http\Resources\ManagerResource;
use App\Http\Resources\SupermarketResource;
use App\Models\Manager;
use App\Models\Supermarket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupermarketController extends Controller
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
            'town'=>'required|string|max:50',
            'country'=>'required|string|max:50',

        ]);

        $supermarket=Supermarket::create([
            'name'=>$validated['name'],
            'town'=>$validated['town'],
            'country'=>$validated['country']
        ]);
        return redirect()->back()
            ->with('status','Supermarket saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $supermarket=new SupermarketResource(Supermarket::with(['managers'])->findOrFail($id));
        return inertia::render('supermarket/show', compact('supermarket'));
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
            'town'=>'required|string|max:50',
            'country'=>'required|string|max:50',

        ]);

        $supermarket=Supermarket::findOrFail($id);
        $supermarket->update([
            'name'=>$validated['name'],
            'town'=>$validated['town'],
            'country'=>$validated['country']
        ]);
        return redirect()->back()
            ->with('status','Supermarket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $supermarket=Supermarket::findOrFail($id)->delete();
        return redirect()->back()
            ->with('status','Supermarket deleted successfully');
    }

    public function suppliers($id){
        $supermarket=new SupermarketResource(Supermarket::with(['suppliers'])->findOrFail($id));
        return inertia::render('supermarket/suppliers', compact('supermarket'));
    }

    public function managers($super, $id){
     $supermarket=Supermarket::findOrFail($super);
     $manager=new ManagerResource(Manager::with('employees')->findOrFail($id));
     return inertia::render('supermarket/manager', compact('supermarket','manager'));
    }
}
