<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //product list
    public function productList(){
        $products=Product::orderBy('id','desc')->get();
        return response()->json($products, 200);
    }

      //product list filter  By Id
     public function productListById($id){
        //  return $id;
        $product=Product::where('id',$id)->first();
        if(isset($product)){
            return response()->json($product, 200);
        }else{
             return response()->json(['message'=>'There is no data...'], 500);
        }

    }

    //product create
    public function createProduct(Request $request){
        // return $request->all();
        $data=$this->getData($request);
        Product::create($data);
        $products=Product::orderBy('id','desc')->get();
        return response()->json(['message'=>'successful create','products'=>$products], 200,);
    }


    private function getData($request){
        $data=[
            'name'=>$request->name,
            'category_id'=>$request->categoryId,
            'description'=>$request->description,
            'waiting_time'=>$request->waiting_time,
            'price'=>$request->price,
            'created_at'=>Carbon::now(),
        ];
        return $data;
    }
}
