@extends('layouts.final')
@section('title')
    Cart
@endsection
@section('pageTitle')
    Cart
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
        <div class="">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0 ?>
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        <?php $total += $details['price'] * $details['quantity'] ?>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">${{ $details['price'] }}</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" data-id="{{$id}}"/>
                            </td>
                            <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        </tr>
                    @endforeach
                @else
                <h1>No data found</h1>
                @endif
                </tbody>
                <tfoot>
                <tr class="visible-xs">
                    <td></td>
                    <td></td>
                    <td><strong>Total</strong></td>
                    <td class="text-center"><strong> {{ $total }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="hidden-xs"></td>
                    <td><strong>Total</strong></td>
                    <td class="hidden-xs text-center"><strong> ${{ $total }}</strong></td>
                </tr>
                </tfoot>
            </table>
            @if(session('cart'))
            <div class="col-lg-3 col-sm-3 col-3 text-center checkout" style="float: right">
                <a href="{{ url('checkout') }}" class="btn btn-primary btn-block">checkout</a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script src="{{ asset('js/front.js') }}"></script>
@endsection