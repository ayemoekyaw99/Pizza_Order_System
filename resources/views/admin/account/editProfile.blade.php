@extends('admin.layouts.master')

@section('title', 'Account Profile Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 offset-1">
                        <div class="card">
                            <a href="{{route('admin#accountInfo')}}">
                                <button class="au-btn btn-dark text-white col-2 offset-9 btn mt-3">Back</button>
                            </a>
                            <div class="card-title mt-3">
                                <h3 class="text-center title-2">Account Information</h3>
                            </div>

                            <hr>
                            <div class="col-4 offset-5 mt-2">
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                               <span class="text-center"> {{session('status')}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                            <div class="card-body">
                                <form action="{{ route('admin#updateProfile') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender=='female')
                                                    <img src="{{asset('images/female.png')}}" alt="" class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{asset('images/male.jpg')}}" alt="" class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                            <img src="{{asset('storage/'.$user->image)}}" alt="" class="img-thumbnail shadow-sm">
                                            @endif

                                            <div class="m-t-80">
                                                <label>Upload Image</label>
                                                <input type="file" name="image" id=""
                                                    class="form-control au-input au-input--full ">
                                                     @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>

                                             <button class="au-btn au-btn--green m-b-20 btn-block m-t-20"
                                            type="submit">Update</button>
                                        </div>

                                        <div class="col-6 offset-1">

                                            <input type="hidden" name="userId" value="{{ $user->id }}">

                                            <div class="form-group">
                                                <label>Username</label>
                                                <input class="au-input au-input--full" type="text" name="name"
                                                    placeholder="Username" value="{{ old('name', $user->name) }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input class="au-input au-input--full" type="email" name="email"
                                                    placeholder="Email" value="{{ old('email', $user->email) }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="au-input au-input--full" type="number" name="phone"
                                                    placeholder="09xxxxxx" value="{{ old('phone', $user->phone) }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control" cols="30" rows="10">{{ old('address', $user->address) }}</textarea>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender" id="" class="form-select">
                                                    <option value="">Choose gender..</option>
                                                    <option value="male" @if (Auth::user()->gender=='male') selected @endif>Male</option>
                                                    <option value="female" @if (Auth::user()->gender=='female') selected @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Role</label>
                                                <input type="text" name="role" value="{{ old('role', $user->role) }}"
                                                    class="form-control au-input au-input--full" disabled>
                                                @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
