<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'name', 
        'description', 
        'price', 
        'image', 
        'image_url'
    ];

   
    public function getImageUrlAttribute($value)
    {
  
        if ($value) {
            return $value;
        }
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-food.png');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}