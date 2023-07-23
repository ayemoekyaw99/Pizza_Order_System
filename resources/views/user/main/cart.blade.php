@extends('user.layouts.master')

@section('title','Cart List')

@section('content')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0 tableData">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle tbody">
                    @foreach ($cartList as $c)
                        <tr>
                            {{-- <input type="hidden" name="" value="{{$c->pizza_price}}" class="pizzaPrice"> --}}
                            <input type="hidden" id="userId" value={{$c->user_id}}>
                            <input type="hidden" id="productId" value={{$c->product_id}}>
                            <input type="hidden" id="cartId" value={{$c->id}}>

                            <td class="align-middle"><img src="{{asset('storage/'.$c->pizza_image)}}" alt="" style="width: 50px"></td>
                            <td class="align-middle">{{$c->pizza_name}}</td>
                            <td class="align-middle" id="pizzaPrice">{{$c->pizza_price}}kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm  border-0 text-center qty" value="{{$c->quantity}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle total" >{{$c->pizza_price*$c->quantity}} kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                    Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 class="subTotal">{{$totalPrice}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 class="totalPrice">{{$totalPrice+3000}}kyats</h5>
                    </div>
                    <button class="btn btn-block btn-info font-weight-bold my-3 py-3 btn-order">Proceed To Checkout</button>
                    <button class="btn btn-block btn-info font-weight-bold my-3 py-3 btn-clear">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection


{{-- JQuery --}}

@section('scriptSource')

<script src="{{asset('js/cart.js')}}"></script>

<script>
    $(document).ready(function(){

        $('.btn-order').click(function(){

            $orderList=[];
            $random=Math.floor((Math.random() * 1000000) + 1);//jquery random

            $('.tableData tbody tr').each(function(index,row){
                $orderList.push({
                    'user_id':$(row).find('#userId').val(),
                    'product_id':$(row).find('#productId').val(),
                    'qty':$(row).find('.qty').val(),
                    'total':parseInt($(row).find('.total').text().replace('kyats','')),
                    'order_code':'POS'+ $random,
                });
            });

            $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/orderList',
            data:Object.assign({}, $orderList),
            dataType:'json',
            success:function(response){
               if(response=='success'){
                window.location.href = "http://127.0.0.1:8000/user/home";
               }
             }
            });
        });

        $('.btn-remove').click(function() {
            $parentNode = $(this).parents('tr');
            $cartId=$parentNode.find('#cartId').val();
            // console.log($cartId);
            $.ajax({
                type:'get',
                dataType:'json',
                url:'http://127.0.0.1:8000/user/ajax/btnRemove',
                data:{'cart_id':$cartId},
                success:function(response){
                    console.log(response);
                }
            });
            $parentNode.remove();
            summaryCalculation();

        })

        $('.btn-clear').click(function(){

            $('.tableData tbody tr').remove();
            $('.subTotal').html("0 kyat");
            $('.totalPrice').html('0 kyat');


           $.ajax({
                type:'get',
                dataType:'json',
                url:'http://127.0.0.1:8000/user/ajax/btnCartClear',
                success:function(response){
                }
           })
        })

        //calculate final price
        function summaryCalculation() {
        $totalPrice = 0;
        $('.tableData tbody tr').each(function(index, row) {
        //console.log(index + '///'+row)
        $totalPrice += parseInt($(row).find('.total').text().replace('kyats', ''));
        });
        $('.subTotal').text(`${$totalPrice}`);
        $('.totalPrice').text(`${$totalPrice+3000} kyats`);
        }

    });
</script>

@endsection
