@extends('user.layouts.master')

@section('title','User Change Password')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

@section('content')

 <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-4 offset-5 mt-2">
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                               <span class="text-center"> {{session('status')}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>

                        <div class="col-6 offset-3">
                            <div class="card">
                                <div class="card-body">

                                     @if (session('notMatch'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <span class="text-center"> {{session('notMatch')}}</span>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                    <div class="card-title">
                                        <h3 class="text-center title-2"> Change Password </h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                                        @csrf

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Old password</label>
                                            <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old password..." value="{{old('oldPassword')}}">
                                            @error('oldPassword')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New password</label>
                                            <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New password...">
                                            @error('newPassword')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirm password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm password...">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                                <span id="payment-button-amount">Change</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </form>
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
