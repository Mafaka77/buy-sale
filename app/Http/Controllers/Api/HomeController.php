<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getCategory(Request $request)
    {
        $category=Category::query()->limit(8)->get();
        return response()->json(['data'=>$category],200);

    }
    public function getAllCategory(Request $request)
    {
        $category=Category::query()->get();
        return response()->json(['data'=>$category],200);

    }

    public function getAdsByCategory(Request $request)
    {
        $catId=$request->catId;
        $subCatId=$request->subCatId;
       $ads=Post::query()
           ->where('category_id',$catId)
           ->where('sub_category_id',$subCatId)
           ->with('postImage')
           ->orderBy('created_at','desc')
           ->get();
       return response()->json(['data'=>$ads],200);

    }
}
