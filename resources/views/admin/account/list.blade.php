@extends('admin.layouts.master')

@section('title','Admin List')

@section('content')

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="col-9 offset-1">

                            <div class="row m-2">
                                <div class="col-3">
                                    <h4 class="text-muted">Search key:  <span class="text-danger">{{request('searchKey')}}</span></h4>
                                </div>

                                <div class="col-4 offset-5">
                                    <form action="{{route('admin#list')}}" method="get" >
                                        <div class="d-flex mb-3">
                                            <input type="text" class="form-control" name="searchKey" placeholder="Search here..." value="{{request('searchKey')}}">
                                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                                         </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <h3 class="col-2 offset-8 bg-white btn text-center text-black fs-4">
                                 <i class="fa-solid fa-database"></i>  {{$users->total()}}
                                </h3>
                            </div>

                            <div class="col-5 offset-8 mt-2">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span class="text-center">{{session('status')}}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>

                            <div class="card mt-5">
                                <div class="card-body">

                                    <div class="card-title">
                                        <h3 class="text-center title-2"> Account List  </h3>
                                    </div>
                                    <hr>
                                    <div class="row">

                                        @foreach ($users as $user)

                                        <div class="col-3  mb-3">
                                           @if ($user->image ==null)
                                                 @if ($user->gender=='male')
                                                        <img src="{{ asset('images/male.jpg') }}"
                                                                 alt="John Doe" class="img-thumbnail shadow-sm w-100"/>
                                                @else
                                                        <img src="{{ asset('images/female.png') }}"
                                                                 alt="John Doe" class="img-thumbnail shadow-sm w-100"/>
                                                @endif

                                           @else

                                                <img src="{{asset('storage/'.$user->image)}}"  class="w-100 img-thumbnail shadow-sm" alt="image">
                                           @endif
                                        </div>

                                        <div class="col-8 offset-1  mb-2 d-flex">
                                           <div class="info col-7">
                                            {{-- <span>{{$user->id}} ({{Auth::user()->id}})</span> --}}
                                                    <h4 class="my-3 "> <i class="fa-solid fa-user px-2"></i>   {{$user->name}}</h4>
                                                    <h4 class="my-3"><i class="fa-solid fa-envelope px-2"></i>{{$user->email}}</h4>
                                                    <h4 class="my-3">  <i class="fa-solid fa-phone px-2"></i>{{$user->phone}}</h4>
                                                    <h4 class="my-3"><i class="fa-solid fa-location-dot px-2"></i>{{$user->address}}</h4>
                                                    <h4 class="my-3"><i class="fa-solid fa-mars-and-venus px-2"></i>{{$user->gender}}</h4>
                                                    <span class="my-3"><i class="fa-solid fa-briefcase px-2"></i>{{$user->role}}</span>
                                                    <span class="my-3"> <i class="fa-solid fa-calendar px-2"></i>{{$user->created_at->format('j-F-Y')}}</span>
                                           </div>

                                           <div class="col-4 offset-1">

                                                   <div class="table-data-feature mt-5">

                                                    @if (Auth::user()->id==$user->id)

                                                    @else
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                        <a href="{{route('admin#changeRole',$user->id)}}"><i class="fa-solid fa-user-minus"></i></a>
                                                        </button>

                                                         <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <a href="{{route('admin#delete',$user->id)}}"><i class="zmdi zmdi-delete"></i></a>
                                                        </button>
                                                    @endif

                                                </div>
                                           </div>
                                        </div>
                                        <hr class="text-danger">
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                             {{$users->links()}}
                        </div>
                    </div>
                </div>
    </div>


@endsection
