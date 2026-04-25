<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
 use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'role'];
  

  public function orders(){
     return $this->hasmany(Order::class);
  }


  public function bookings(){
  return $this->hasmany(Booking::class);   


  }
}
