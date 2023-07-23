@extends('admin.layouts.master')

@section('title','Category information')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container mt-3">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-title mt-3">
                            <h3>Category Infomation </h3>
                        </div>
                        <div class="card-body ">
                            <div class="text  mb-2">
                                <h2 class="btn btn-dark d-block mb-2 text-white"> ID:   {{$category->id}}</h2>
                                <h2 class="btn btn-dark d-block mb-2 text-white"> Name:   {{$category->name}}</h2>
                                <h2 class="btn btn-dark d-block mb-2 text-white"> Created_at:  {{$category->created_at->format('d-m-Y')}}</h2>
                            </div>
                            <div class="col-3 offset-9">
                                <a href="{{route('category#edit',$category->id)}}">
                                    <button type="submit" class="btn btn-info px-5 py-2 m-2">Edit</button>
                                </a>
                                 <a href="{{route('category#list')}}">
                                    <button type="submit" class="btn btn-info px-5 py-2 m-2">Back</button>
                                 </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
