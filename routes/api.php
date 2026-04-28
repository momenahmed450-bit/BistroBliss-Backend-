<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\{
    MenuItemController, OrderItemController, UserController,
    CategoryController, OrderController, AuthController, BookingController
};


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::post('/contact', [AuthController::class, 'handleContact']); 

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::get('/my-orders', [OrderController::class, 'userOrders']); 
    Route::post('/bookings', [BookingController::class, 'store']); 
});


Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
  Route::get('/admin/bookings', [BookingController::class, 'index']);

  
    Route::apiResource('menu-items', MenuItemController::class)->except(['index', 'show']);
    
   
    Route::apiResource('categories', CategoryController::class);
    
    
  
    
    
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);
    
    Route::apiResource('users', UserController::class);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
      Route::get('/admin/bookings', [BookingController::class, 'index']); 

    
});
Route::get('/status', function () {
    return response()->json(['message' => 'Backend is connected!']);
});