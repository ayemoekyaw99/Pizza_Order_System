@extends('admin.layouts.master')

@section('title','Order List')

{{-- body content --}}
@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>
                        </div>
                    </div>

                </div>

                <div class="row m-2">
                    <div class="col-3">
                        <h4 class="text-muted">Search key: <span class="text-danger">{{request('searchKey')}}</span>
                        </h4>
                    </div>
                    <div class="col-4 offset-5">
                        <form action="{{route('order#list')}}" method="get">
                            <div class="d-flex mb-3">
                                <input type="text" class="form-control" name="searchKey" placeholder="Search here..."
                                    value="{{request('searchKey')}}">
                                <button type="submit" class="btn btn-dark "><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-4 mt-1">
                    <form action="{{route('order#statusChange')}}" method="get">
                     @csrf
                        <label for="" class="form-label">OrderStatus</label>
                        <div class="col-4 d-flex">
                            <div class="input-group mb-3">
                                <select name="statusChange" class="form-select text-center">

                                    <option value="null" class="text-dark"> All</option>
                                    <option value='0'  @if  (request('statusChange')=='0') selected @endif  class="text-warning"> Pending</option>
                                    <option value='1' @if  (request('statusChange')=='1') selected @endif class="text-success">Success</option>
                                    <option value='2' @if  (request('statusChange')=='2') selected @endif class="text-danger">Reject</option>
                                </select>
                                <button class="btn btn-dark text-white" type="submit" >Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-3 offset-9 mt-3">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-center">{{session('status')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>

                <div class="table-responsive table-responsive-data2">
                    @if (count($orders) !=0)
                    <table class="table table-data2 text-center dataTable">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Created At</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orders as $order)

                            <tr class="tr-shadow ">
                                <input type="hidden" name="" class="orderId" value="{{$order->id}}">
                                <td>{{$order->user_name}}</td>
                                <td class="fs-6"><a href="{{route('order#productList',$order->order_code)}}" >{{$order->order_code}}</a> </td>
                                <td >{{$order->total_price}}</td>
                                <td>{{$order->created_at->format('F-j-Y')}}</td>
                                <td>

                                    <select name=""  class="form-select text-center changeStatusDb">

                                        <option value="0"  @if ($order->status=='0') selected @endif class="text-warning"> Pending</option>
                                        <option value="1"  @if ($order->status=='1') selected @endif class="text-success">Success</option>
                                        <option value="2"  @if ($order->status=='2') selected @endif class="text-danger">Reject</option>
                                    </select>
                                </td>
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
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<!-- END MAIN CONTENT-->
@endsection

{{-- js code --}}
@section('scriptSource')

<script>
    $(document).ready(function(){

        //status change must be select box class name , not id (important)
        $('.changeStatusDb').change(function(){
            $parentNode=$(this).parents('tr');
            $currentStatus=$(this).val();
            $orderId=$parentNode.find('.orderId').val();
             console.log($orderId);
             console.log($currentStatus);

            $.ajax({
                type:'get',
                dataType:'json',
                data:{'orderId':$orderId,'status':$currentStatus},
                url:'http://127.0.0.1:8000/order/status/changeDb',
            })

        })
    })

</script>

@endsection
