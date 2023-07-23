@extends('user.layouts.master')

@section('title','Contact')

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-6 offset-3 ">

                <div class="col-4 offset-5 mt-1">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-center"> {{session('status')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>

                <div class="card mb-5 mt-2" >
                    <div class="card-title">
                        <h3 class="text-center mt-1 text-primary">Contact Us</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user#contact')}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="type" class="form-control text-info fs-5" id="floatingInput" placeholder="name" name="name" value={{Auth::user()->name}}>
                                <label for="floatingInput">Name</label>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control text-info fs-5" id="floatingInput" placeholder="name@example.com" name="email" value={{Auth::user()->email}}>
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control text-info fs-5" placeholder="Leave a message here" id="floatingTextarea2" name="message" style="height: 100px" >{{old('message')}}</textarea>
                                <label for="floatingTextarea2">Messages</label>
                                @error('message')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-6 offset-4 mt-2 mb-3">
                                <button class="btn btn-secondary text-warning fs-5 px-4" type="submit">SEND</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
