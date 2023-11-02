<?php

namespace App\Http\Controllers;

use App\Models\FurnishType;
use Illuminate\Http\Request;

class FurnishTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/ManageFurnishType',[
            'furnishType'=>FurnishType::query()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'furnish_name'=>'required',
        ]);
        FurnishType::query()->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(FurnishType $furnishType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FurnishType $furnishType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FurnishType $furnishType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FurnishType $furnishType)
    {
        //
    }
}
