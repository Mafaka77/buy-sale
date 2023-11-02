<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/ManageBrandsPage',[
            'category'=>Category::query()->get(),
            'brands'=>Brand::query()->with('category')->get(),
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

        if($request->hasFile('logo')){
            $file=$request->file('logo');
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
            'brand_name'=>'required',
            'brand_logo'=>'required',
            'category_id'=>'required'
        ]);
        Brand::query()->create($data);
        return to_route('brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
