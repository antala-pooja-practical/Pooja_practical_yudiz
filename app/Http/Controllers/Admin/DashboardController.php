<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController  extends Controller
{
    public function index(Request $request)
    {
        //Top 10 Selling Product List
        $topSelling = OrderProduct::select(DB::raw("SUM(qty) AS countQty"),'product_id')
                        ->groupBy('product_id')->OrderBy(DB::raw("SUM(qty)"),'desc')
                        ->limit(10)->get();
        return view('admin.dashboard',compact('topSelling'));
    }
    
    
}
