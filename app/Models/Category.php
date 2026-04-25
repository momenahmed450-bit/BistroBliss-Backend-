<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
    ];




    public function menu_items(){
    return $this->hasmany(MenuItem::class);    
    }
}
