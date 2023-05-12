<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupermarketResource;
use App\Models\Supermarket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $supermarkets=SupermarketResource::collection(Supermarket::query()
            ->when(request('search'),function ($q, $search){
                $q->where('name','like', '%'.$search.'%');
            })
        ->get());
        $filter=request('search');
        return inertia::render('welcome',compact('supermarkets','filter'));
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
}
