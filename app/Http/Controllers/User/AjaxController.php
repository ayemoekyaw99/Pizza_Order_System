<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AjaxController extends Controller
{
    //pizza detail
    public function pizzaList(Request $request){
        // logger($request->all());
       if ($request->status=='asc') {
            $pizza = Product::orderBy('id','asc')->get();
       } else {
        $pizza = Product::orderBy('id','desc')->get();
       }
        return response()->json($pizza);
    }

    //click add cart btn
    public function addCart(Request $request){
        // logger($request->all());
        $data=$this->getRequestData($request);
        Cart::create($data);
        return  response()->json('success', 200);

    }


    //click process to checkout
    public function orderList(Request $request){
        $totalPrice=0;
        foreach ($request->all() as $item) {
           $data=OrderList::create(
                [
                    'user_id'=>$item['user_id'],
                    'product_id'=>$item['product_id'],
                    'qty'=>$item['qty'],
                    'total'=>$item['total'],
                    'order_code'=>$item['order_code'],
                ]);
                // logger($data->total);
                $totalPrice += $data->total;
        };
        // logger($totalPrice);
        // logger($data->order_code);

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=>$totalPrice+3000,
        ]);

        return response()->json('success', 200,);

    }

    //click remove btn
    public function btnRemove(Request $request){
        // logger($request->all());
        Cart::where('id',$request->cart_id)->delete();
        return  response()->json('success', 200,);
    }

    //click clear btn
    public function btnCartClear(Request $request){
        Cart::where('user_id',Auth::user()->id)->delete();

    }

    //add view count in db
    public function addViewCount(Request $request){
         logger($request->all());
        // logger($request->product_id);
        $data=['view_count'=>$request->view_count+1];
        $pizza=Product::where('id',$request->product_id)->update($data);
        return response()->json($pizza, 200,);
    }

    private function getRequestData($request){
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'quantity'=>$request->countPizza,
        ];
    }
}