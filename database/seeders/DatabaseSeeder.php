<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

  
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bistro.com'],
            [
                'name' => 'Momen Admin',
                'password' => bcrypt('123456'),
                'role' => 'admin'
            ]
        );

        $mainDishes = Category::create(['name' => 'Main Dishes']);
        $drinks = Category::create(['name' => 'Drinks']);
        $breakfast = Category::create(['name' => 'Breakfast']);

        
        MenuItem::create([
            'category_id' => $mainDishes->id,
            'name' => 'Grilled Chicken',
            'description' => 'Special herbs and spices grilled chicken with a side of veggies.',
            'price' => 250.00,
            'image_url' => 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=400'
        ]);

        MenuItem::create([
            'category_id' => $mainDishes->id,
            'name' => 'Grilled Salmon',
            'description' => 'Fresh Atlantic salmon grilled to perfection with lemon butter sauce.',
            'price' => 350.00,
            'image_url' => 'https://images.unsplash.com/photo-1485921325833-c519f76c4927?q=80&w=400',
        ]);

        MenuItem::create([
            'category_id' => $mainDishes->id,
            'name' => 'Beef Burger XL',
            'description' => 'Double beef patty with melted cheddar, lettuce, and our special sauce.',
            'price' => 220.00,
            'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=400',
        ]);

       
        MenuItem::create([
            'category_id' => $drinks->id,
            'name' => 'Fresh Orange Juice',
            'description' => '100% natural orange juice pressed daily.',
            'price' => 60.00,
            'image_url' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?q=80&w=400',
        ]);

        
        MenuItem::create([
            'category_id' => $breakfast->id,
            'name' => 'Classic Omelette',
            'description' => 'Fluffy eggs with cheese and fresh herbs.',
            'price' => 85.00,
            'image_url' => 'https://images.unsplash.com/photo-1510627489930-0c1b0ba8fa75?w=400',
        ]);
    }
}