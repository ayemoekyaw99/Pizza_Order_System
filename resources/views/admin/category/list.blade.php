@extends('admin.layouts.master')

@section('title','Category List')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#create')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                <div class="row m-2">
                    <div class="col-3">
                        <h4 class="text-muted">Search key:  <span class="text-danger">{{request('searchKey')}}</span></h4>
                    </div>
                     <div class="col-4 offset-5">
                        <form action="{{route('category#list')}}" method="get" >
                        <div class="d-flex mb-3">
                            <input type="text" class="form-control" name="searchKey" placeholder="Search here..." value="{{request('searchKey')}}">
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                   </form>
                     </div>
                </div>

                <div class="row">
                    <h3 class="col-2 offset-8 bg-white btn text-center text-black fs-4">
                      <i class="fa-solid fa-database"></i>  {{$categories->total()}}
                    </h3>
                </div>


                <div class="col-3 offset-9 mt-3">
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="text-center">{{session('status')}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                </div>
                <div class="table-responsive table-responsive-data2">
                    @if (count($categories) !=0)
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created_at</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="tr-shadow ">
                                <tr class="spacer"></tr>

                                <td>{{$category->id}}</td>
                                <td class="col-6">
                                    {{$category->name}}
                                </td>
                                <td>
                                   {{$category->created_at->format('d-m-Y')}}

                                </td>
                                <td>
                                                <div class="table-data-feature">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <a href="{{route('category#edit',$category->id)}}"><i class="zmdi zmdi-edit"></i></a>
                                                    </button>
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="More">
                                                       <a href="{{route('category#show',$category->id)}}"> <i class="zmdi zmdi-more"></i></a>
                                                    </button>
                                                     <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <a href="{{route('category#delete',$category->id)}}"><i class="zmdi zmdi-delete"></i></a>
                                                    </button>
                                                </div>
                                            </td>
                            </tr>

                            <tr class="spacer"></tr>
                            @endforeach

                        </tbody>
                    </table>

                    @else
                        <div class=" text-center">
                            <p class="fs-1 text-danger">There is no data</p>
                        </div>
                    @endif

                   <div class="mt-3">
                     {{-- {{$categories->appends(request()->query())->links()}} --}}
                     {{$categories->links()}}
                   </div>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- END MAIN CONTENT-->
@endsection




