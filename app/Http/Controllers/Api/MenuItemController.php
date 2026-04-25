<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem; 

class MenuItemController extends Controller
{
   
    public function index()
    {
        try {
            $menuItems = MenuItem::with('category')->get();
            return response()->json($menuItems, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء جلب البيانات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu_images', 'public');
            $validated['image'] = $path;
        }

        $menuItem = MenuItem::create($validated);
        return response()->json($menuItem, 201);
    }

    public function show($id)
    {
        $menuItem = MenuItem::with('category')->find($id);
        if (!$menuItem) {
            return response()->json(['message' => 'الصنف غير موجود'], 404);
        }
        return response()->json($menuItem, 200);
    }
}