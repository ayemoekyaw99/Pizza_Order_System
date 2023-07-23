@extends('layouts.master')

@section('title','Register Page')

@section('content')

<div class="login-form">

    @error('terms')
    <span class="text-danger">{{$message}}</span>
    @enderror


    <form action="{{route('register')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="Username" value="{{old('name')}}">
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{old('email')}}">
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input class="au-input au-input--full" type="number" name="phone" placeholder="09xxxxxx" value="{{old('phone')}}">
            @error('phone')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="Address" value="{{old('address')}}">
            @error('address')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender" id="" class="form-select">
                <option value="">Choose gender..</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @error('gender')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password" value="{{old('password')}}">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password" value="{{old('password_confirmation')}}">
            @error('password_confirmation')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
    </form>

    <div class="register-link">
        <p>
            Already have account?
            <a href="{{url('loginPage')}}">Sign In</a>
        </p>
    </div>
</div>

@endsection
