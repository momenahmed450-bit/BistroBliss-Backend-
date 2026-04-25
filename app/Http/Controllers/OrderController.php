<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
      $orders = Order::with(['user', 'items.menuItem'])->latest()->get();
        return response()->json($orders, 200);
    }

   
    public function store(Request $request)
    {
     $validated = $request->validate([
            'user_id'        => 'required|exists:users,id',
            'total_price'    => 'required|numeric|min:0',
            'address'        => 'required|string|max:500',
            'phone'          => 'required|string',
            'payment_method' => ['required', Rule::in(['cash', 'card'])],
            'notes'          => 'nullable|string',
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }

   
    public function show(order $order)
    {
       $order = Order::with(['user', 'items.menuItem'])->findOrFail($id);
        return response()->json($order, 200);
    }

  
    public function update(Request $request, order $order)
    {
      $validated = $request->validate([
            'status' => [Rule::in(['pending', 'accepted', 'in_progress', 'delivered', 'rejected'])],
            'address' => 'sometimes|string',
            'phone'   => 'sometimes|string',
        ]);

        $order->update($validated);
        return response()->json($order, 200);
    }

  
    public function destroy(order $order)
    {
  $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200); 
    }
}
