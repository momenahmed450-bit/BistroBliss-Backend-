<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    
    
    
        public function index(Request $request) {
        $query = OrderItem::with(['menuItem']);
        if ($request->has('order_id')) {
            $query->where('order_id', $request->order_id);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'     => 'required|exists:orders,id',
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity'     => 'required|integer|min:1',
        ]);

        $menuItem = MenuItem::findOrFail($request->menu_item_id);
        $validated['price'] = $menuItem->price * $request->quantity;

        $orderItem = OrderItem::create($validated);
        return response()->json($orderItem, 201);
    }


    public function show(string $id)
    {
        return OrderItem::with('menuItem')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $menuItem = MenuItem::findOrFail($orderItem->menu_item_id);
        $orderItem->update([
            'quantity' => $request->quantity,
            'price'    => $menuItem->price * $request->quantity
        ]);

        return response()->json($orderItem);
    }

    public function destroy(string $id)
    {
        OrderItem::findOrFail($id)->delete();
        return response()->json(['message' => 'Item removed from order']);
    }
}
