<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
     protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'address',
        'phone',
        'payment_method',
        'notes',



     ];




    public function items() { 
    return $this->hasMany(OrderItem::class); 
}

public function user() {
return $this->belongsTo(User::class); 

}
}
