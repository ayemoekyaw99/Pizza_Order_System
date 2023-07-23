@extends('user.layouts.master')

@section('title','History List')

@section('content')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0 tableData">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Order Code</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                    <tr>

                        {{-- <input type="hidden" id="userId" value={{$c->user_id}}>
                        <input type="hidden" id="productId" value={{$c->product_id}}> --}}

                        <td class="align-middle">{{$o->created_at->format('F-d-Y')}}</td>
                        <td class="align-middle">{{$o->order_code}}</td>
                        <td class="align-middle" id="pizzaPrice">{{$o->total_price}} kyats</td>
                        <td class="align-middle">
                              @if ($o->status==0)
                                <span class="text-warning"><i class="fa-solid fa-spinner"></i> Pending</span>
                              @elseif($o->status==1)
                                <span class="text-success"><i class="fa-solid fa-check"></i> Success</span>
                              @else
                              <span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i>  Reject</span>
                              @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection



{{-- JQuery --}}

@section('scriptSource')

@endsection
