<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Celulares', 'description' => 'Smartphones de las mejores marcas.'],
            ['name' => 'Laptops', 'description' => 'Equipos portátiles para trabajo y gaming.'],
            ['name' => 'Audio', 'description' => 'Audífonos, parlantes y equipos de sonido.'],
            ['name' => 'Gaming', 'description' => 'Consolas, controles y accesorios gamer.'],
            ['name' => 'Accesorios', 'description' => 'Cables, cargadores, fundas y más.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
