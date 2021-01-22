<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{  
    protected $table = 'order_product';

    public function Orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
                    
    }
}
