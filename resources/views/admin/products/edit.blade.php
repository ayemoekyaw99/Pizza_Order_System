@extends('admin.layouts.master')

@section('title','Pizza Create')

@section('content')

    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('product#show',$product->id)}}"><button class="btn bg-dark text-white my-3">Back</button></a>
                            </div>
                        </div>

                        <div class="col-4 offset-5 mt-2">
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                               <span class="text-center"> {{session('status')}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>

                        <div class="col-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2"> Update Pizza </h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('product#update',$product->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                              <img src="{{asset('storage/'.$product->image)}}" alt="pizza_image" class="img-thumbnail shadow-sm w-100">

                                            <div class="form-group mt-3">
                                                <label for="cc-payment" class="control-label mb-1">Upload image</label>
                                                <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Update</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                                </button>
                                            </div>

                                            </div>
                                            <div class="col-6 offset-1">
                                                 <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                                            <input id="cc-pament" name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" value="{{old('productName',$product->name)}}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                            @error('productName')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category Name</label>

                                            <select name="categoryName" id="" class="form-select @error('categoryName') is-invalid @enderror" value="{{old('categoryName')}}" >
                                            <option value="">Category Name...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if ($product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                            </select>

                                            @error('categoryName')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                           <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{old('description',$product->description)}}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time </label>
                                            <input id="cc-pament" name="waiting_time" type="number" class="form-control @error('waiting_time') is-invalid @enderror" value="{{old('waiting_time',$product->waiting_time)}}" aria-required="true" aria-invalid="false" placeholder="Enter Waiting time...">
                                            @error('waiting_time')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price </label>
                                            <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror"  value="{{old('price',$product->price)}}" aria-required="true" aria-invalid="false" placeholder="$100...">
                                            @error('price')
                                                <div class="invalid-feedback">{{$message}}</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection

