<?php
namespace App\Helpers;

use App\User;
use App\Products;
use Illuminate\Support\Facades\DB;

class CommonHelper {
    
    function getUsreName($id){
        $user = User::find($id);
        return $user;
    }
    function getProductName($id){
        $products = Products::find($id);
        return $products;
   }
}

