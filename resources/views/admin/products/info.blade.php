@extends('admin.layouts.master')

@section('title','Product Information')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container mt-3">
            <div class="row ">
                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-title mt-3">
                                <h3 class="text-center ">Product Information </h3>
                        </div>
                        <hr>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 offset-1">
                                    <img src="{{asset('storage/'.$product->image)}}" alt="pizza_image" class="img-thumbnail shadow-sm w-100">
                                </div>
                                <div class="col-5">
                                    <h4 class="btn btn-dark text-white text-start mb-3 fs-5"> Name:   {{$product->name}}</h4>
                                    <h4 class="btn btn-dark text-white text-start mb-3 fs-5"> Category Name:   {{$product->category_name}}</h4>
                                    <h4 class="btn btn-dark text-white text-start mb-3 fs-5"> Price:   {{$product->price}}</h4>
                                </div>
                            </div>

                            <div class="col-11 offset-1  mt-3">
                                <p class=" fs-5">{{$product->description}}</p>
                                <span class="fs-5"><i class="fa-solid fa-eye mt-3 px-2"></i> {{$product->view_count}}</span>
                                <span class="fs-5"><i class="fa-solid fa-clock  mt-3 px-2"></i>{{$product->waiting_time}}</span>
                            </div>

                            <div class="col-3 offset-9 mb-2">
                                <button class="btn btn-dark text-white" onclick="history.back()">Back</button>
                                <a href="{{route('product#edit',$product->id)}}">
                                    <button class="btn btn-dark text-white ">Edit</button>
                                </a>
                            </div>


                            {{-- <div class="col-3 offset-9">
                                <a href="">
                                    <button type="submit" class="btn btn-info px-5 py-2 m-2">Edit</button>
                                </a>
                                 <a href="">
                                    <button type="submit" class="btn btn-info px-5 py-2 m-2">Back</button>
                                 </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
