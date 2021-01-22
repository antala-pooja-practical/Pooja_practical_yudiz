@extends('admin.layout.final')
@section('title')
    Dashboard
@endsection
@php
$product_status = config('constant.product_status');
@endphp
@section('pageTitle')
    Dashboard
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        @if (Session::has('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button> 
                <strong>{!!session('success')!!}</strong>
            </div>
            {{Session::forget('success')}}
            @endif
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Dashboard</h3>
          </div>
          <div class="col-sm-6"></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive-md table-responsive">
                @if(count($topSelling)>0)
                <table id="product_listing" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th> 
                            <th>Total Selling</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $j = 1;
                        @endphp 
                        @foreach($topSelling as $val)
                        @php $product = (new \App\Helpers\CommonHelper)->getProductName($val->product_id);@endphp
                        <tr id="{{$val->id}}">
                            <td>{{$j}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product[$val->status]}}</td> 
                            <td>{{$val->countQty}}</td>
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
        </div>
    </div>
</section>
@endsection
