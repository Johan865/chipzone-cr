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
            ['cat' => 'Celulares', 'name' => 'Galaxy Nova X200', 'price' => 349900, 'stock' => 25],
            ['cat' => 'Celulares', 'name' => 'iPhone 17 Pro', 'price' => 699900, 'stock' => 15],
            ['cat' => 'Celulares', 'name' => 'Pixel 10', 'price' => 459900, 'stock' => 18],
            ['cat' => 'Laptops', 'name' => 'UltraBook Air 14"', 'price' => 549900, 'stock' => 10],
            ['cat' => 'Laptops', 'name' => 'GamerPro RTX Edition', 'price' => 899900, 'stock' => 6],
            ['cat' => 'Laptops', 'name' => 'ChromeLite 11"', 'price' => 189900, 'stock' => 20],
            ['cat' => 'Audio', 'name' => 'Audífonos NoiseCancel Pro', 'price' => 79900, 'stock' => 40],
            ['cat' => 'Audio', 'name' => 'Parlante Bluetooth BoomBox', 'price' => 45900, 'stock' => 30],
            ['cat' => 'Gaming', 'name' => 'Consola PlayXtreme 5', 'price' => 349900, 'stock' => 12],
            ['cat' => 'Gaming', 'name' => 'Control Inalámbrico Pro', 'price' => 32900, 'stock' => 50],
            ['cat' => 'Accesorios', 'name' => 'Cargador Rápido 65W', 'price' => 14900, 'stock' => 80],
            ['cat' => 'Accesorios', 'name' => 'Power Bank 20000mAh', 'price' => 24900, 'stock' => 60],
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
                    'image_url' => 'https://placehold.co/400x400?text=' . urlencode($p['name']),
                    'active' => true,
                ]
            );
        }
    }
}
