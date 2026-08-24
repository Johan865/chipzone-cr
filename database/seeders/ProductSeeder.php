<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catId = fn (string $name) => Category::where('name', $name)->value('id');

        $products = [
            ['cat' => 'Celulares', 'name' => 'Galaxy Nova X200', 'price' => 349900, 'stock' => 25, 'img' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Celulares', 'name' => 'iPhone 17 Pro', 'price' => 699900, 'stock' => 15, 'img' => 'https://images.unsplash.com/photo-1616348436168-de43ad0db179?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Celulares', 'name' => 'Pixel 10', 'price' => 459900, 'stock' => 18, 'img' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Laptops', 'name' => 'UltraBook Air 14"', 'price' => 549900, 'stock' => 10, 'img' => 'https://images.unsplash.com/photo-1531297172868-9f1d1b5377f7?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Laptops', 'name' => 'GamerPro RTX Edition', 'price' => 899900, 'stock' => 6, 'img' => 'https://images.unsplash.com/photo-1600861194942-f883de0dfe96?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Laptops', 'name' => 'ChromeLite 11"', 'price' => 189900, 'stock' => 20, 'img' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Audio', 'name' => 'Audífonos NoiseCancel Pro', 'price' => 79900, 'stock' => 40, 'img' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Audio', 'name' => 'Parlante Bluetooth BoomBox', 'price' => 45900, 'stock' => 30, 'img' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Gaming', 'name' => 'Consola PlayXtreme 5', 'price' => 349900, 'stock' => 12, 'img' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Gaming', 'name' => 'Control Inalámbrico Pro', 'price' => 32900, 'stock' => 50, 'img' => 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Accesorios', 'name' => 'Cargador Rápido 65W', 'price' => 14900, 'stock' => 80, 'img' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?q=80&w=400&h=400&fit=crop'],
            ['cat' => 'Accesorios', 'name' => 'Power Bank 20000mAh', 'price' => 24900, 'stock' => 60, 'img' => 'https://images.unsplash.com/photo-1609081524932-9dae1539a738?q=80&w=400&h=400&fit=crop'],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'category_id' => $catId($p['cat']),
                    'name' => $p['name'],
                    'description' => "Descripción de ejemplo para {$p['name']}. Editar con las especificaciones reales del producto.",
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'image_url' => $p['img'],
                    'active' => true,
                ]
            );
        }
    }
}
