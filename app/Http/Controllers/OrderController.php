<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders=Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->when(request('searchKey'),function($query){
                        $query->orWhere('orders.order_code','like','%'.request('searchKey').'%')
                            ->orWhere('orders.total_price','like','%'.request('searchKey').'%');
                    })
                    ->orderBy('id','desc')
                    ->get();

        return view('admin.order.orderList',compact('orders'));
    }

    public function statusChange(Request $request){
             logger($request->all());
            //   logger($request->status);
            //   logger( gettype($request->status));

            //first way
        // if ($request->status=='null') {
        //         $orders=Order::select('orders.*','users.name as user_name')
        //                 ->leftJoin('users','users.id','orders.user_id')
        //                 ->get();
        //         return response()->json($orders, 200, );

        // } else {
        //     $orders=Order::select('orders.*','users.name as user_name')
        //                 ->leftJoin('users','users.id','orders.user_id')
        //                 ->where('status',$request->status)
        //                 ->get();
        //     return response()->json($orders, 200,);
        //  }

        // or second way
        $orders=Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->orderBy('orders.id','desc');

        if ($request->statusChange=='null') {
                 $orders=$orders->get();
         } else {
             $orders=$orders->where('status',$request->statusChange)->get();
          }
          //dd($orders->toArray());
           return view('admin.order.orderList',compact('orders'));
    }

    // status change in db

    public function statusChangeDb(Request $request){
         logger($request->all());
        $orders=Order::where('id',$request->orderId)->update(['status'=>$request->status]);
        return view('admin.order.orderList',compact('orders'));
    }

    public function productList($orderCode){

       $productLists=OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_lists.order_code',$orderCode)
                    ->get();
                    
        $order=Order::where('order_code',$orderCode)->first();
         //dd($productLists->toArray());
         //dd(count($productLists));
        return view('admin.order.productList',compact('productLists','order'));
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}