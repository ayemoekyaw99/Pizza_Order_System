<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Cart;
use App\Models\Order;

class UserController extends Controller
{
    //home
    public function home(){
        $pizzaes=Product::orderBy('id','desc')->get();
        $categories=Category::get();
        $cartList=Cart::where('user_id',Auth::user()->id)->get();
        $orderList=Order::where('user_id',Auth::user()->id)->get();
        // dd($cartList);
        //$countList = (count ($cartList));
         return view('user.main.home',compact('pizzaes','categories','cartList','orderList'));

    }

     //filter by Category Name
    public function filter($categoryId){
        $pizzaes = Product::where('category_id',$categoryId)->get();
        $categories=Category::get();
        $cartList=Cart::where('user_id',Auth::user()->id)->get();
        $orderList=Order::where('user_id',Auth::user()->id)->get();
        //$countList = (count ($cartList));

        return view('user.main.home',compact('pizzaes','categories','cartList','orderList'));
    }

    //password
    public function changePasswordPage(){
        return view('user.password.changePassord');
    }
    public function changePassword(Request $request){

        $this->checkValidator($request);

        $user=User::where('id',Auth::user()->id)->first();
        $dbPassword=$user->password;
        // dd($dbPassword);
        $oldPassword=($request->oldPassword);

        if (Hash::check($oldPassword, $dbPassword)) {
                $newPassword=Hash::make($request->newPassword);
                User::where('id',Auth::user()->id)->update(['password'=>$newPassword]);
                return back()->with(['status'=>'Successful Password Updated']);

        }else{

           return back()->with(['notMatch'=>'Old password does not match.Try again!']);
        }

    }

    //account
    public function accountInfo(){
        return view('user.account.accountInfo');
    }

    public function editProfilePage(){
        return view('user.account.editProfile');
    }

    public function editProfile(Request $request){

         $id=$request->userId;
        $this->checkData($request);
        $data=$this->getData($request);

        if($request->hasFile('image')){
            $oldImage=User::where('id',$id)->first()->toArray();
            $oldImage=($oldImage['image']);

            if($oldImage!=null){
                Storage::delete('public/'.$oldImage);
            }

            $fileName =uniqid().$request->file('image')->getClientOriginalName();
             $request->file('image')->storeAs('public', $fileName);
            $data['image']=$fileName;
        }
          User::where('id',$id)->update($data);
        return back()->with(['status'=>'Successful account updated']);

    }

    //pizzaDetail
    public function pizzaDetail($pizzaId){
        $pizza  =Product::where('id',$pizzaId)->first();
        $pizzaList=Product::get();
       return view('user.main.detail',compact('pizza','pizzaList'));
    }

    // cartList
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)->get();

        $totalPrice=0;
        foreach ($cartList as $c) {
            $totalPrice+=$c->pizza_price*$c->quantity;
            //  dd( $totalPrice);
        }
        return view('user.main.cart',compact('cartList','totalPrice',));
    }

    //my cartList
     public function myCart(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)->get();

        $totalPrice=0;
        foreach ($cartList as $c) {
            $totalPrice+=$c->pizza_price*$c->quantity;
            //  dd( $totalPrice);
        }
        return view('user.main.mycart',compact('cartList','totalPrice',));
    }

    //user history
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.history',compact('order'));
    }

    private function checkValidator($request){

        $validateData=[
            'oldPassword' =>'required|min:6|max:10',
            'newPassword' =>'required|min:6|max:10',
            'confirmPassword' =>'required|min:6|max:10|same:newPassword',
        ];
        Validator::make($request->all(),$validateData)->validate();
    }

    private function checkData($request){
        $validateData=[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$request->userId,
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:jpg,png,jpeg,bmp,tiff,webp|file',
        ];
        Validator::make($request->all(),$validateData)->validate();
    }

    private function getData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
        ];
    }

}