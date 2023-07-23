@extends('user.layouts.master')

@section('title','User')


@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Filter by Category Name Start -->
            <h5 class="position-relative text-uppercase mb-3">Filter by Category</h5>

            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">Categories</label>
                        <span class="badge border font-weight-bold text-warning fs-5">{{ count($categories) }}</span>
                    </div>

                    <div class="custom-control d-flex align-items-center justify-content-between mb-3 ">
                        <a href="{{route('user#home')}}" class="text-dark"><label class="" for="price-1">All</label></a>
                    </div>

                    @foreach ($categories as $category)
                    <div class="custom-control d-flex align-items-center justify-content-between mb-3 ">
                        <a href="{{route('user#filter',$category->id)}}" class="text-dark"><label class=""
                                for="price-1">{{ $category->name }}</label></a>
                    </div>
                    @endforeach
                </form>
            </div>
            <!-- Filter by Category Name Start End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                           <a href="{{route('user#cartList')}}">
                            <button type="button" class="btn btn-warning position-relative">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{count($cartList)}}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                           </a>
                           <a href="{{route('user#history')}}" class="ms-3">
                            <button type="button" class="btn btn-warning position-relative">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{count($orderList)}}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </a>
                        </div>
                        <div class="ml-2">
                            <select class="form-select" aria-label="Default select example" id="sorting">
                                <option value="" selected>Sorting...</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>
                </div>

                @if(count($pizzaes)==0)
                <h2 class="text-center fs-2 text-danger ">There is no data</h2>
                @else
                <span class="row" id="dataList">
                    <a href="detail.html">
                        @foreach ($pizzaes as $pizza)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">

                                <div class="product-img position-relative overflow-hidden d-flex">
                                    <img class="img-fluid w-100 " style="height:130px"
                                        src="{{ asset('storage/' .$pizza->image) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square"
                                            href="{{route('user#pizzaDetail',$pizza->id)}}"><i
                                                class="fa-solid fa-circle-info"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $pizza->price }} kyats</h5>
                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </a>
                </span>
                @endif

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
@endsection
<!-- Shop End -->


{{-- //JQuery Link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- //JQuery --}}
@section('scriptSource')
<script>
    $(document).ready(function(){
            $('#sorting').change(function(){
               $eventOption = $('#sorting').val();

               if ($eventOption=='asc') {
                        $.ajax({
                        type:'get',
                        url:'/user/ajax/pizzaList',
                        data:{'status':'asc'},
                        dataType:'json',
                        success:function(response){
                        // console.log(response)
                        // console.log(response[0].name)

                        $list='';
                        for ($i = 0;$i<response.length; $i++) {
                            //console.log(`${response[$i].name}`)
                            $list +=`<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">

                                <div class="product-img position-relative overflow-hidden d-flex">
                                    <img class="img-fluid w-100 " style="height:130px" src="{{ asset('storage/${response[$i].image}' ) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5>
                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div> `;
                        }
                            $('#dataList').html($list);
                        }

                        })

               }  else if($eventOption=='desc'){
                            $.ajax({
                            type:'get',
                            url:'/user/ajax/pizzaList',
                            data:{'status':'desc'},
                            dataType:'json',
                            success:function(response){
                            $list='';
                            for ($i = 0;$i<response.length; $i++) {
                            //console.log(`${response[$i].name}`)
                            $list +=`<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">

                                <div class="product-img position-relative overflow-hidden d-flex">
                                    <img class="img-fluid w-100 " style="height:130px" src="{{ asset('storage/${response[$i].image}' ) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5>
                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div> `;
                        }
                            $('#dataList').html($list);
                    }
                })
               }
            })
        })

</script>
@endsection
