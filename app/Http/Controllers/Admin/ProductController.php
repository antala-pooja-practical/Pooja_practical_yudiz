<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Products;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ProductController  extends Controller
{
    //Product Listing
    public function index(Request $request)
    {
        $dataQuery = new Products();
        if ($request->has('search_submit') && $request->search_submit != '') {
            if ($request->has('search_by_product') && $request->search_by_product != '') {
                $dataQuery=  $dataQuery->where('id', $request->search_by_product);
            }
        }


        $product = $dataQuery->paginate(10);
        return view('admin.products.index',compact('product','request'));
    }

    //Add Product view
    public function addProduct(Request $request)
    {
        return view('admin.products.add');
    }

    //Store Product
    public function storeProduct (Request $request) {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_qut' => 'required',
            'product_status' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/product/add')
                        ->withErrors($validator)
                        ->withInput();
        }
        $product = new Products();
        $product->name = $request->product_name;
        $product->quantity = $request->product_qut;
        $product->price = $request->price;
        $product->status = $request->product_status;
        $product->save();
        
        return redirect('/admin/products')->with('success', 'Product create successfully!');
    }
}
