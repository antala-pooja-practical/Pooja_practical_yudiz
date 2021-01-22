<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Products;
use App\Order;
use APp\OrderProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController  extends Controller
{
    //Order Listing
    public function index(Request $request)
    {

        $que = Order::with(['OrderProducts']);
        $order = $que->paginate(10);
        return view('admin.order.index',compact('order','request'));
    }

    
}
