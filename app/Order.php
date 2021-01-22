<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{  
    protected $table = 'order';

    public function OrderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
