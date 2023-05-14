<?php

namespace App\Http\Controllers;

use App\Events\SupplierAddEvent;
use App\Models\Supermarket;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class SuppliersController extends Controller
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
            'phone'=>'required|string|max:25',
            'town'=>'required|string|max:50',
            'country'=>'required|string|max:50',
            'supermarket_id'=>'required|integer'

        ]);
        $supplier=Supplier::create($validated);

        return redirect()->back()
            ->with('status','Supplier  created successfully');
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
            'phone'=>'required|string|max:25',
            'town'=>'required|string|max:50',
            'country'=>'required|string|max:50',

        ]);
        //dd($validated);

        $supplier=Supplier::findOrFail($id);
        $supplier->update($validated);
        return redirect()->back()
            ->with('status','Supplier  updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $supplier=Supplier::findOrFail($id)->delete();
        return redirect()->back()
            ->with('status','Supplier deleted successfully');
    }

    public function saveSupplier(Request $request){
       $validated=$request->validate([
           'supermarket_id'=>'required|integer',
           'suppliers'=>'required|mimes:xlsx,xls'
       ]);

       $supermarket=Supermarket::findOrFail($validated['supermarket_id']);

        $suppliers = (new FastExcel)->import($request->file('suppliers'));

        //validate that the Excel fields contain the required columns
        $verifiedExcel=Validator::make($suppliers->toArray(),[
            'name'=>'required|string|max:50',
            'phone'=>'required|string|max:25',
            'town'=>'required|string|max:50',
            'country'=>'required|string|max:50',
        ]);
         event(new SupplierAddEvent($supermarket, $suppliers));

         return redirect()->back();



    }
}
