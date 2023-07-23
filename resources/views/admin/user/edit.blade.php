@extends('admin.layouts.master')

@section('title','User Edit')

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid mt-2">
            <div class="col-10 offset-1">
                <div class="card">
                    <a href="{{route('user#list')}}" class="text-dark ms-3 mt-1">
                       <i class="fa-solid fa-arrow-left"></i> back
                    </a>
                    <div class="card-title mt-1">
                        <h3 class="text-center title-2">Account Information</h3>
                    </div>

                    <hr>
                    <div class="col-4 offset-5 mt-1">
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="text-center"> {{session('status')}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{route('user#updateUser')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($user->image == null)
                                        @if ($user->gender=='female')
                                        <img src="{{asset('images/female.png')}}" alt="" class="img-thumbnail shadow-sm">
                                        @else
                                        <img src="{{asset('images/male.jpg')}}" alt="" class="img-thumbnail shadow-sm">
                                        @endif
                                    @else
                                    <img src="{{asset('storage/'.$user->image)}}" alt="" class="img-thumbnail shadow-sm">
                                    @endif

                                    <div class="m-t-80">
                                        <label>Upload Image</label>
                                        <input type="file" name="image" id="" class="form-control au-input au-input--full ">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button class="au-btn au-btn--green m-b-20 btn-block m-t-20" type="submit">Update</button>
                                </div>

                                <div class="col-6 offset-1">

                                    <input type="hidden" name="userId" value="{{ $user->id }}">

                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="au-input au-input--full" type="text" name="name" placeholder="Username"
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input class="au-input au-input--full" type="email" name="email" placeholder="Email"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="au-input au-input--full" type="number" name="phone" placeholder="09xxxxxx"
                                            value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" cols="30"
                                            rows="10">{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="" class="form-select">
                                            <option value="">Choose gender..</option>
                                            <option value="male" @if ($user->gender=='male') selected @endif>Male</option>
                                            <option value="female" @if ($user->gender=='female') selected @endif>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                        <span class="text-danger">{{$message}}</span>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<!-- END MAIN CONTENT-->
@endsection
