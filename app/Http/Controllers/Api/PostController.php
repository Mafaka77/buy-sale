<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImages;
use App\Models\PropertyHouse;
use App\Models\SubCategory;
use App\Models\Vehicles;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getSubCategory(Request $request,int $id)
    {
        $subCategory=SubCategory::query()
            ->where('category_id',$id)
            ->with('category')
            ->get();
        info($subCategory);
        return response()->json(['data'=>$subCategory],200);
    }

    public function submitMobilePost(Request $request)
    {
        $data=$request->data;
        DB::transaction(function () use($data,$request){
            $post=Post::query()->create($data);
            if ($images=$request->file('images')) {
                foreach ($images as $image){
//                $imagePath=Cloudinary::upload($image->getRealPath());
                    $imageName =time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('uploads', $imageName, 'public');
                    PostImages::query()->create([
                        'image_url'=>$imagePath,
                        'post_id'=>$post->id
                    ]);
                }
                return response()->json( 200);

            } else {
                info('NO IMAGE');
                return response()->json(['message' => 'Image upload failed'], 400);
            }
        });

    }

    public function submitVehiclePost(Request $request)
    {
        $data=$request->data;
        $vehicle=$request->get('vehicles');
        DB::transaction(function () use ($data,$vehicle,$request){
            $post=Post::query()->create($data);
            if ($images=$request->file('images')) {
                foreach ($images as $image){
//                $imagePath=Cloudinary::upload($image->getRealPath());
                    $imageName =time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('uploads', $imageName, 'public');
                    PostImages::query()->create([
                        'image_url'=>$imagePath,
                        'post_id'=>$post->id
                    ]);
                }
                    Vehicles::query()->create([
                        'model'=>$vehicle['model'],
                        'km'=>$vehicle['km'],
                        'post_id'=>$post->id,
                    ]);

                return response()->json( 200);

            } else {
                info('NO IMAGE');
                return response()->json(['message' => 'Image upload failed'], 400);
            }

        });
    }

    public function submitPropertyAds(Request $request)
    {
        $data=$request->data;
        $houseRent=$request->houses;
        DB::transaction(function () use ($data,$houseRent,$request){
            $post=Post::query()->create($data);
            if ($images=$request->file('images')) {
                foreach ($images as $image){
//                $imagePath=Cloudinary::upload($image->getRealPath());
                    $imageName =time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('uploads', $imageName, 'public');
                    PostImages::query()->create([
                        'image_url'=>$imagePath,
                        'post_id'=>$post->id
                    ]);
                }
                if($houseRent['totalArea']!=NULL){
                    PropertyHouse::query()->create([
                        'totalArea'=>$houseRent['totalArea'],
                        'totalFloor'=>$houseRent['totalFloor'],
                        'floorNo'=>$houseRent['floorNo'],
                        'post_id'=>$post->id,
                    ]);
                }
                return response()->json( 200);

            } else {
                info('NO IMAGE');
                return response()->json(['message' => 'Image upload failed'], 400);
            }
        });
    }

}
