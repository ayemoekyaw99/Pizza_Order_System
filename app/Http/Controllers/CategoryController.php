<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkValidator($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#create')->with('status','successful Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category,$id)
    {
        $category=Category::where('id',$id)->first();
        return view('admin.category.info',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category,$id)
    {
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category,)
    {
      $this->checkValidator($request);
      $data=$this->requestCategoryData($request);
      Category::where('id',$request->categoryId)->update($data);
      return redirect()->route('category#list')->with('status','Successful updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category,$id)
    {
        Category::find($id)->delete();
        return redirect()->route('category#list')->with('status','Successul Deleletd');

    }

    //admin
    public function list(){
        $categories=Category::when(request('searchKey'),function($query)
        {
            $key=request('searchKey');
            $query->where('name','like','%'.$key.'%');
        })
        ->orderBy('id','desc')
        ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //dashboard
    public function dashboard(){
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');

        } else {
           return redirect()->route('user#home');
        }

    }

    private function checkValidator($request){
        $validateData = [
            'categoryName' =>"required|string|max:255|unique:categories,name,".$request->categoryId,
        ];
        Validator::make($request->all(),$validateData)->validate();
    }

    private function requestCategoryData($request){
        return [
            'name'=>$request->categoryName,
        ];

    }
}