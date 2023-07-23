@extends('admin.layouts.master')

@section('title','Product List')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid mt-3">
            <div class="col-md-12">
                <div class="mb-3">
                    <a href="{{route('order#list')}}"><i class="fa-solid fa-arrow-left text-dark"></i></a>
                </div>

                @if (count($productLists)!=0)
                    <div class="card col-6" >
                        <div class="card-body">
                            <div class="card-title mb-3">
                                <div class="d-flex">
                                    <i class="fa-solid fa-clipboard-list fs-5 me-3"></i>
                                    <h4>Order Info</h4>
                                </div>
                                <div class="text-warning mt-3 fs-5">Include devilery charge</div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-5">
                                    <div class="mb-4">
                                        <i class="fa-solid fa-user me-3"></i><span>Name</span>
                                    </div>
                                    <div class="mb-4">
                                        <i class="fa-solid fa-barcode me-3"></i><span>Order Code</span>
                                    </div>
                                    <div class="mb-4">
                                        <i class="fa-regular fa-clock me-3"></i><span>Order Date</span>
                                    </div>
                                    <div class="mb-4">
                                       <i class="fa-solid fa-money-check-dollar me-3"></i><span>Total</span>
                                    </div>
                                </div>
                                @foreach ($productLists as $productList)
                                @endforeach
                                <div class="col-5">
                                    <div class="mb-4 text-uppercase">{{$productList->user_name}}</div>
                                    <div class="mb-4">{{$productList->order_code}}</div>
                                    <div class="mb-4">{{$productList->created_at->format('F-j-Y')}}</div>
                                    <div class="mb-4">{{$order->total_price}}</div>
                                </div>

                            </div>

                        </div>
                    </div>
                @else
                    <div class="text-danger">There is no Order List</div>
                @endif

                <div class="table-responsive table-responsive-data2 mt-4">
                    @if (count($productLists) !=0)
                    <table class="table table-data2 text-center dataTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase">Order Id</th>
                                <th class="text-uppercase">Product Image</th>
                                <th class="text-uppercase">Product Name</th>
                                <th class="text-uppercase">Order Date</th>
                                <th class="text-uppercase">Qty</th>
                                <th class="text-uppercase">Amount</th>

                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($productLists as $productList)

                            <tr class="tr-shadow ">
                                <td>{{$productList->id}}</td>
                                <td class="col-3"> <img src="{{asset('storage/'.$productList->product_image)}}" alt="image" style="width:30%"></td>
                                <td>{{$productList->product_name}}</td>
                                <td>{{$productList->created_at->format('F-j-Y')}}</td>
                                <td>{{$productList->qty}}</td>
                                <td>{{$productList->total}}</td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">

                    </div>

                    @else
                    <div class=" text-center">
                        <p class=" fs-1 text-danger">There is no data</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<!-- END MAIN CONTENT-->

@endsection
