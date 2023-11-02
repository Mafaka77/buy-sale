<?php

namespace App\Http\Controllers;

use App\Models\Featured;
use App\Models\Post;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featured=Featured::query()->get();
        $post=Post::query()->get();
        return inertia('Admin/ManageFeaturedPage',[
            'featured'=>$featured
        ]);
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
    public function show(Featured $featured)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Featured $featured)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Featured $featured)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Featured $featured)
    {
        //
    }
}
