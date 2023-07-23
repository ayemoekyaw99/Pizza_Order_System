<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products=Product::select('products.*','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->when(request('searchKey'),function($query){
                            $key=request('searchKey');
                            $query->where('products.name','like','%'.$key.'%');
                            })
                            ->orderBy('products.id','desc')
                            ->paginate(3);

        $products->appends(request()->all());
        // dd($products->toArray());
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        //dd($categories);
        // foreach ($categories as $category) {
        //    echo ($category->name);
        // }
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkValidate($request,"create");
       $data=$this->getData($request);

       if($request->hasFile('image')){
            $fileName=uniqid(). $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$fileName);
            $data['image']=$fileName;
       }

        Product::create($data);
        return back()->with(['status'=>'Successful created']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product,$id)
    {
        $product=Product::select('products.*','categories.name as category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->where('products.id',$id)->first();
                        // dd($product->toArray());
        // $category=$product->category->name; or
        // dd($category);
        return view('admin.products.info',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product,$id)
    {
        $product=Product::where('id',$id)->first();
        $categories=Category::get();
        // $category =$product->category->name;
        //dd($category);
        return view('admin.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       //dd($request->id);
      $this->checkValidate($request,"update");
       $updateData=$this->getData($request);

       if($request->hasFile('image')){

                $oldName=Product::select('image')->where('id',$id)->first();
                $oldName=$oldName->image;
                if($oldName!=null){
                Storage::delete('public/'.$oldName);
                }

                $fileName=$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/',$fileName);
                $updateData['image']=$fileName;

        }

       Product::where('id',$id)->update($updateData);
       return redirect()->route('product#edit',$id)->with(['status'=>'Successful Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product,$id)
    {
        Product::where('id',$id)->delete();
        return back()->with(['status'=>'Successful deleted']);
    }

    private function checkValidate($request,$action){

        $validateRule =[
            'productName'=>'required|unique:products,name,'.$request->id,
           'categoryName'=>'required',
           'description'=>'required',
           'price'=>'required',
           'image'=>'required|mimes:jpg,png,jpeg,bmp,tiff,webp|file',
           'waiting_time'=>'required',
        ];
        $validateRule['image'] = $action == "create" ? 'required|mimes:jpg,png,jpeg,bmp,tiff,webp' : 'mimes:jpg,png,jpeg,bmp,tiff,webp';

        Validator::make($request->all(),$validateRule)->validate();
    }

    private function getData($request){
        return [
            'name'=>$request->productName,
            'category_id'=>$request->categoryName,
            'description'=>$request->description,
            'price'=>$request->price,
            'waiting_time'=>$request->waiting_time,
        ];
    }



}
