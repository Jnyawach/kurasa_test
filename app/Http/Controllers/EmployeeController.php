<?php

namespace App\Http\Controllers;

use App\Events\EmployeeAddEvent;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\Supermarket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class EmployeeController extends Controller
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
            'name'=>'string|max:50|required',
            'type'=>'string|max:50|required',
            'gender'=>'string|max:50|required'
        ]);

        $employee=Employee::findOrFail($id);
        $employee->update($validated);
        return redirect()->back()
            ->with('status','Employee update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $employee=Employee::findOrFail($id)->delete();

        return redirect()->back()
            ->with('status','Employee deleted successfully');
    }

    public function saveEmployee(Request $request){
        $validated=$request->validate([
            'manager_id'=>'required|integer',
            'employees'=>'required|mimes:xlsx,xls'
        ]);

        $manager=Manager::findOrFail($validated['manager_id']);

        $employees = (new FastExcel)->import($request->file('employees'));

        //validate that the Excel fields contain the required columns
        $verifiedExcel=Validator::make($employees->toArray(),[
            'name'=>'required|string|max:50',
            'phone'=>'required|string|max:25',
            'town'=>'required|string|max:50',
            'country'=>'required|string|max:50',
        ]);

        event(new EmployeeAddEvent($manager, $employees));

        return redirect()->back();
    }
}
