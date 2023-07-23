@extends('user.layouts.master')

@section('title', 'Product Detail')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

@section('content')

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">

        <div class="mb-2">
            <a href="{{route('user#home')}}"class="text-decoration-none"><i class="fa-solid fa-arrow-left text-dark"></i><span class="text-dark ">back</span></a>
        </div>

        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$pizza->name}}</h3>
                <input type="hidden" id="userId" value="{{Auth::user()->id}}" >
                <input type="hidden" id="pizzaId" value="{{$pizza->id}}">
                <input type="hidden" id="viewCount" value="{{$pizza->view_count}}">
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(99 Reviews)</small>
                </div>

                <div class="div mb-2">
                    <i class="fa-sharp fa-solid fa-eye ms-2"></i>{{$pizza->view_count+1}}
                </div>

                <h3 class="font-weight-semi-bold mb-4">{{$pizza->price}}</h3>
                <p class="mb-4">{{$pizza->description}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control  border-0 text-center" value="1" id="countPizza">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary px-3" id="addCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="https://www.twitter.com/" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="https://www.pinterest.com/" target="_blank" rel="noopener noreferrer" >
                            <i class="fab fa-pinterest"></i>
                        </a>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach($pizzaList as $p)

                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$p->price}}Kyats</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>

                        </div>
                    </div>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- Jquery --}}
@section('scriptSource')

    <script>
        $(document).ready(function(){

            // console.log($('#pizzaId').val());
            $productId=$('#pizzaId').val();
            $viewCount=$('#viewCount').val();
            $.ajax({
                type:'get',
                dataType:'json',
                data:{'product_id':$productId,'view_count':$viewCount},
                url:'http://127.0.0.1:8000/user/ajax/addViewCount',
            })

            $('#addCart').click(function(){
                $source={
                    'userId':$('#userId').val(),
                    'pizzaId':$('#pizzaId').val(),
                    'countPizza':$('#countPizza').val(),
                }
                //console.log($source);

                $.ajax({
                    type:'get',
                    dataType:'json',
                    url:'http://127.0.0.1:8000/user/ajax/addCart',
                    data:$source,
                    success:function(response){
                        //console.log(response)
                        if (response=='success') {
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                })
            })
        });
    </script>


@endsection
