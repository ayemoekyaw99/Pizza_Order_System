<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

    //category list
    public function categoryList(){
        $categories=Category::get();
        return response()->json($categories, 200);
    }

    //category list filter  By Id
     public function categoryListById($id){
        //  return $id;
        $category=Category::where('id',$id)->first();
        if(isset($category)){
            return response()->json($category, 200);
        }else{
             return response()->json(['message'=>'There is no data...'], 500);
        }

    }

    //create category from body form-data
    public function createCategory(Request $request){
        // return $request->all();
        // return $request->name;
        $data=['name'=>$request->name,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                ];
        Category::create($data);
        $categories=Category::get();
        return response()->json(['status'=>'success','category'=> $categories], 200);
    }

    //delete category from body form-data
    public function deleteCategory(Request $request){
        //  return $request->all();
        // return $request->header('headerdata');

        $data=Category::where('id',$request->id)->first();

        if(isset($data)){
            Category::where('id',$request->id)->delete();
            return response()->json(['status'=>true,'message'=>'successful deleted','deletedData'=>$data],200);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no data'],500,);
        }
    }

    //delete category filter by Id
    public function deleteCategoryById($id){
        //return $id;
        $data=Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>true,'message'=>'successful deleted','deletedData'=>$data],200);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no data'],500,);
        }
    }

    //update category
    public function updateCategory(Request $request){
        // return $request->all();
        $data=Category::where('id',$request->id)->first();

        if(isset($data)){
            $categoryData=$this->getCategoryUpdate($request);
            Category::where('id',$request->id)->update($categoryData);
            $updateData=Category::where('id',$request->id)->first();
            return response()->json(['status'=>true,'message'=>'category updated','updateData'=>$updateData], 200,);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no data..'], 500,);
        }
    }

    //getCategoryUpdate
    private function getCategoryUpdate($request){
        $categoryData=[
            'name'=>$request->name,
            'updated_at'=>Carbon::now(),
        ];
        return $categoryData;
    }
}