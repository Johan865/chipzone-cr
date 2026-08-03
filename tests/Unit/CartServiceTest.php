<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_calcula_subtotal_correctamente(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Audio', 'slug' => 'audio']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Audífonos',
            'slug' => 'audifonos',
            'price' => 10000,
            'stock' => 10,
        ]);

        $service = new CartService();
        $cart = $service->getOrCreateCart($user);
        $service->addProduct($cart, $product->id, 2);
        $cart->refresh();

        $this->assertEquals(20000, $service->subtotal($cart));
    }

    public function test_aplica_envio_gratis_sobre_el_umbral(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Laptops', 'slug' => 'laptops']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Laptop Pro',
            'slug' => 'laptop-pro',
            'price' => 150000,
            'stock' => 5,
        ]);

        $service = new CartService();
        $cart = $service->getOrCreateCart($user);
        $service->addProduct($cart, $product->id, 1);
        $cart->refresh();

        $this->assertEquals(0.0, $service->shippingCost($cart));
    }
}
