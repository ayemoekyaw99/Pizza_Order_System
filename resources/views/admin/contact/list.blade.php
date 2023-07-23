@extends('admin.layouts.master')

@section('title','Contact Lists')

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
                    @if (count($lists) !=0)
                    <table class="table table-data2 text-center dataTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase">Id</th>
                                <th class="text-uppercase">Name</th>
                                <th class="text-uppercase">Email</th>
                                <th class="text-uppercase">Message</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($lists as $list)
                            <tr class="tr-shadow ">
                                <td class=" text-center " id="contactId">{{$list->id}}</td>
                                <td class=" text-center">{{$list->name}}</td>
                                <td class=" text-center">{{$list->email}}</td>
                                <td class="col-4 offset-0 text-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control contactMessage" value="{{$list->message}}">
                                        <button class="btn btn-outline-secondary btnEdit" type="button"><i class="zmdi zmdi-edit"></i></button>
                                    </div>
                                </td>
                                <td class=" text-center">
                                    <div class="table-data-feature">
                                        <button class="item me-2 btnDelete" data-toggle="tooltip" data-placement="top" title="Delete" id="">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>

                    @else
                    <div class="text-center">
                        <p class="fs-1 text-danger">There is no data</p>
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

        //click btn delete
        $('.btnDelete').click(function(){
            $parentNode=$(this).parents('tr');
            $contactId=$parentNode.find('#contactId').text();
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/contact/ajax/delete',
                data:{'contactId':$contactId},
                dataType:'json',
            })
            $parentNode.remove();
        })

        //click btn edit
        $('.btnEdit').click(function(){
            $parentNode=$(this).parents('tr');
            $contactMessage=$parentNode.find('.contactMessage').val();
            $contactId=$parentNode.find('#contactId').text();
            // console.log($contactMessage);
            // console.log($contactId);
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/contact/ajax/edit',
                data:{'contactId':$contactId,'contactMessage':$contactMessage,},
                dataType:'json',
                success:function(response){
                    console.log(response);
                }
            });


        });

    });
</script>

@endsection
