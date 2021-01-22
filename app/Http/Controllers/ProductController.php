<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Products;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\OrderProduct;

class ProductController  extends Controller
{
    //Product Listing
    public function productsList(Request $request)
    {
        $dataQuery = Products::where('status',1);
        if ($request->has('search_submit') && $request->search_submit != '') {
            if ($request->has('search_by_product') && $request->search_by_product != '') {
                $dataQuery=  $dataQuery->where('id', $request->search_by_product);
            }
        }


        $product = $dataQuery->paginate(10);
        return view('front.products.index',compact('product','request'));
    }
    public function addToCart($id)
    {
        $product = Products::find($id);
        if($product) {
            $cart = session()->get('cart');
            // if cart is empty then this the first product
            if(!$cart) {
                $cart = [
                        $id => [
                            "name" => $product->name,
                            "quantity" => 1,
                            "price" => $product->price,
                        ]
                ];
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
            // if cart not empty then check if this product exist then increment quantity
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ];
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    //Display cart
    public function cart()
    {
        return view('front.products.cart');
    }
    
    //update cart
    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    //checkout
    public function checkout(Request $request){
        $cart = session()->get('cart');
        if(count($cart)>0){
            $totalQty = $totalPrice = 0;
            foreach($cart as $k => $v){
                $totalPrice += $v['price'];
                $totalQty += $v['quantity'];
            }
            //Store order entry
            if($totalQty != 0 && $totalPrice != 0){
                $order = New Order();
                $order->total_qty = $totalQty;
                $order->total_price = $totalPrice;
                $order->user_id = Auth::user()->id;
                $order->save();
            }
            foreach($cart as $k => $v){
                //Store order product entry
                $orderPro = New OrderProduct();
                $orderPro->order_id = $order->id;
                $orderPro->product_id = $k;
                $orderPro->qty = $v['quantity'];
                $orderPro->price = $v['price'];
                $orderPro->save();

            }
        }
        session()->forget('cart');
        return redirect('/list/products')->with('success', 'Order placed successfully!');
    }
}
