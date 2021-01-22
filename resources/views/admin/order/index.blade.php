@extends('admin.layout.final')
@section('title')
    Orders Listing
@endsection
@section('pageTitle')
    Orders Listing
@endsection
@php
$order_status = config('constant.product_status');
@endphp
@section('content')
<?php 
 $search_class = "";
 ?>
 @if(Request::get('search_submit'))
    <?php 
        $search_class = "show";
    ?>
@endif
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Orders Listing</h3>
          </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button> 
                    <strong>{!!session('success')!!}</strong>
                </div>
                {{Session::forget('success')}}
                @endif    

                @if (Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button> 
                    <strong>{!!session('error')!!}</strong>
                </div>
                {{Session::forget('error')}}
                @endif 
                <div class="card">
                    <div class="card-body">
                        @if(count($order)>0)
                            <p class="mt-1">Showing {{ $order->firstItem() }} to {{ $order->lastItem() }} of total {{$order->total()}} entries</p>
                        @endif
                        <div class="table-responsive-md table-responsive">
                            @if(count($order)>0)
                            <table id="product_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $j = $order->firstItem();
                                        $productName = array();
                                    @endphp 
                                    @foreach($order as $val)
                                        <?php 
                                                $getName = (new \App\Helpers\CommonHelper)->getUsreName($val->user_id);
                                                
                                                foreach($val['OrderProducts'] as $proVal){
                                                     $product = (new \App\Helpers\CommonHelper)->getProductName($proVal->product_id);
                                                     $productName[]  = $product->name;
                                                }
                                         ?>
                                    <tr id="{{$val->id}}">
                                        <td>{{$j}}</td>
                                        <td>{{$getName->name}}</td>
                                        <td>{{count($productName)>0?implode(",",$productName):''}}</td>
                                        <td>{{$val->total_qty}}</td>
                                        <td>{{$val->total_price}}</td> 
                                        </td>
                                    </tr>
                                    @php
                                        $j++;
                                    @endphp 
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="border-top">
                                <h4 align="center" style="padding : 20px;">No record found.</h4>
                            </div>
                            @endif
                        </div>
                        @if($order && !empty($order))
                            <div class="pt-4">{!! $order->appends(\Request::except('page'))->render() !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
