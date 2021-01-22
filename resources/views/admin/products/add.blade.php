@extends('admin.layout.final')
@section('title')
    Add Products
@endsection
@section('pageTitle')
Add Products
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
          <div class="col-sm-6">
            <h3>Add Products</h3>
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
                        <form method="POST" action="{{ route('storeProduct') }}" id="productAdd">
                            @csrf
                            <div class="form-group">
                                <label for="proname">Product Name<span class="require_field">*</span>:</label>
                                <input type="text" name="product_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="proname">Product Quantity<span class="require_field">*</span>:</label>
                                <input type="text" name="product_qut" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="proname">Price<span class="require_field">*</span>:</label>
                                <input type="text" name="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Status<span class="require_field">*</span>:</label>
                                @php $product_status = config('constant.product_status'); @endphp
                                <select class="product_status form-control" name="product_status">
                                    <option value="">Select Status</option>
                                    @foreach($product_status as $key => $val)
                                        <option value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                           
                            <div class="form-group">
                                <button style="cursor:pointer" type="submit" class="btn btn-primary" id='cat_submit'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<script src="{{ asset('js/admin.js') }}"></script>
@endsection