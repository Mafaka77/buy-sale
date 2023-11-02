<?php

namespace App\Http\Controllers;

use App\Models\HouseType;
use Illuminate\Http\Request;

class HouseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/ManageHouseType',[
            'houseType'=>HouseType::query()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function uploadIcon(Request $request)
    {

        if($request->hasFile('icon')){
            $file=$request->file('icon');
            $file_name = time().'_'.$file->getClientOriginalName();
            $file_path = $file->storeAs('uploads', $file_name, 'public');
            return response()->json(['data'=>$file_path]);
        }else{
            return response()->json('Error Uploading a file');
        }
    }
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name'=>'required',
            'icon'=>'required'
        ]);
        HouseType::query()->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(HouseType $houseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HouseType $houseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HouseType $houseType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseType $houseType)
    {
        //
    }
}
