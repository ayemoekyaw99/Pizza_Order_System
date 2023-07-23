@extends('user.layouts.master')

@section('title','Account Info')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

@section('content')
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-8 offset-2">
                            <div class="card">
                                <div class="card-body">

                                    <div class="card-title">
                                        <h3 class="text-center title-2"> Account Information  </h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3 offset-2">
                                            <div class="image">
                                            @if (Auth::user()->image==null)
                                                @if (Auth::user()->gender=='female')
                                                    <img src="{{asset('images/female.png')}}" alt="" class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{asset('images/male.jpg')}}" alt="" class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                 <img src="{{asset('storage/'.Auth::user()->image)}}" alt="" class="img-thumbnail shadow-sm">
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-6 offset-1">
                                            <h4 class="my-3 "> <i class="fa-solid fa-user px-2"></i>   {{Auth::user()->name}}</h4>
                                            <h4 class="my-3"><i class="fa-solid fa-envelope px-2"></i>{{Auth::user()->email}}</h4>
                                            <h4 class="my-3">  <i class="fa-solid fa-phone px-2"></i>{{Auth::user()->phone}}</h4>
                                            <h4 class="my-3"><i class="fa-solid fa-location-dot px-2"></i>{{Auth::user()->address}}</h4>
                                            <h4 class="my-3"><i class="fa-solid fa-mars-and-venus px-2"></i>{{Auth::user()->gender}}</h4>
                                            <h4 class="my-3"> <i class="fa-solid fa-calendar px-2"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-3 offset-2">
                                        <a href="{{route('user#editProfilePage')}}">
                                        <button class="btn btn-dark text-white">   <i class="fa-solid fa-pen-to-square px-2"></i>Edit profile</button>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

@endsection
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
