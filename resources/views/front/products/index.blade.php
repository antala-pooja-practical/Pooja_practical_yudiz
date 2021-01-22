@extends('layouts.final')
@section('title')
    Products Listing
@endsection
@section('pageTitle')
Products Listing
@endsection
@php
$product_status = config('constant.product_status');
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
          <div class="col-sm-12">
            <center><h3>Products</h3></center>
          </div>
        </div>
    </div>
    <div class="container-fluid">
        <div id="accordion">
            <div class="card">
                <div class="card-header product-header bg-dark collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h3 class="card-title" style="color: #fff">Product Search</h3>
                </div>
                <div id="collapseOne" class="panel-collapse in collapse show" style="">
                    <form class="form-horizontal" method="get" action="{{url('list/products')}}" name="search_filter" id="search_filter">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg col-md-3 col-sm-3">
                                        <label class="">Product</label>
                                          <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="search_by_product" id="search_by_product">
                                            <option value="">All</option>
                                            @foreach($product as $key => $val)
                                            <option value="{{$val->id}}" {{($request->search_by_product == $val->id)?'selected':''}}>{{$val->name}}</option>
                                            @endforeach 
                                        </select>  
                                    </div>  
                                </div>
                            </div>
                        <div class="card-footer">
                            <button name="search_submit" type="submit" class="btn btn-primary btn-dark" value="1">
                                Search
                            </button>
                            <button name="search_reset" type="button" class="btn btn-info btn-secondary" onclick="location.href='{{url('list/products')}}'">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
                        @if(count($product)>0)
                            <p class="mt-1">Showing {{ $product->firstItem() }} to {{ $product->lastItem() }} of total {{$product->total()}} entries</p>
                        @endif
                        <div class="table-responsive-md table-responsive">
                            @if(count($product)>0)
                            <table id="product_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $j = $product->firstItem();
                                    @endphp 
                                    @foreach($product as $val)
                                    <tr id="{{$val->id}}">
                                        <td>{{$j}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->quantity}}</td>
                                        <td>{{$val->price}}</td>
                                        <td>{{$product_status[$val->status]}}</td> 
                                        <td>
                                            <form action="" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $val->id }}" id="id" name="id">
                                                <input type="hidden" value="1" id="quantity" name="quantity">
                                                <div class="">
                                                      <div class="">
                                                        <a href="{{ url('add-to-cart/'.$val->id) }}" class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                            <i class="fa fa-shopping-cart"></i> add to cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
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
                        @if($product && !empty($product))
                            <div class="pt-4">{!! $product->appends(\Request::except('page'))->render() !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
