@extends('admin.layouts.master')

@section('title','User List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid mt-3">
            <div class="col-3 offset-6">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-center"> {{session('status')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="col-md-12">
                <div class="table-responsive table-responsive-data2 mt-4">
                    @if (count($users) !=0)
                    <table class="table table-data2 text-center dataTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase">Image</th>
                                <th class="text-uppercase">Name</th>
                                <th class="text-uppercase">Email</th>
                                <th class="text-uppercase">Address</th>
                                <th class="text-uppercase">Phone</th>
                                <th class="text-uppercase">Gender</th>
                                <th class="text-uppercase ">Role</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($users as $user)

                            <tr class="tr-shadow ">
                                <input type="hidden" id="userId" value="{{$user->id}}">
                                <td class="col-3">
                                    @if ($user->image==null)
                                       @if ($user->gender=='female')
                                            <img src="{{asset('images/female.png')}}" alt="image" class="img-thumbnail" style="width:60%">
                                       @else
                                            <img src="{{asset('images/male.jpg')}}" alt="image" class="img-thumbnail" style="width:60%">
                                       @endif
                                    @else
                                        <img src="{{asset('storage/'.$user->image)}}" alt="image" style="width:60%" class="img-thumbnail">
                                    @endif
                                </td>
                                <td class="col-1">{{$user->name}}</td>
                                <td class="col-2">{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->gender}}</td>
                                <td class="col-2">
                                    <select name="" id="" class="form-select changeRole">
                                        <option value="user" @if ($user->role=='user')  selected @endif>User</option>
                                        <option value="admin"@if ($user->role=='admin')  selected @endif>Admin</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                          <a href="{{route('user#editUser',$user->id)}}"> <i class="zmdi zmdi-edit"></i></a>
                                        </button>
                                        <button class="item me-2 btnDelete" data-toggle="tooltip" data-placement="top" title="Delete" id="">
                                            <i class="zmdi zmdi-delete"></i></a>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">

                    </div>

                    @else
                    <div class=" text-center">
                        <p class=" fs-1 text-danger">There is no data</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

@endsection

@section('scriptSource')

<script>
    $(document).ready(function(){

        //change role in table we use class name instead of id(#) ,use (.classname)
        $('.changeRole').change(function(){
           $parentNode=$(this).parents('tr');
           $role=$parentNode.find('.changeRole').val();
        //    console.log($role);
            $user_id=$parentNode.find('#userId').val();
            // console.log($userId);
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax/change/role',
                data:{'role':$role,'user_id':$user_id},
                dataType:'json',
            })
            $parentNode.remove();
        })

        //delete user // in table we use class name instead of id(#) ,use (.classname)
        $('.btnDelete').click(function(){
            $parentNode=$(this).parents('tr');
            $user_id=$parentNode.find('#userId').val();
            $role=$parentNode.find('.changeRole').val();

            $.ajax({
                type:'get',
                dataType:'json',
                data:{'user_id':$user_id,'role':$role},
                url:'http://127.0.0.1:8000/user/ajax/deleteUser',
            })
            $parentNode.remove();
        })
    })
</script>

@endsection
