<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(array $overrides = []): Product
    {
        $category = Category::create(['name' => 'Celulares', 'slug' => 'celulares']);

        return Product::create(array_merge([
            'category_id' => $category->id,
            'name' => 'Teléfono Demo',
            'slug' => 'telefono-demo',
            'price' => 100000,
            'stock' => 10,
        ], $overrides));
    }

    public function test_un_usuario_autenticado_puede_agregar_un_producto_al_carrito(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        $response = $this->actingAs($user)->post("/carrito/{$product->id}", ['quantity' => 2]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cart_items', ['product_id' => $product->id, 'quantity' => 2]);
    }

    public function test_un_invitado_no_puede_acceder_al_carrito(): void
    {
        $response = $this->get('/carrito');

        $response->assertRedirect('/login');
    }

    public function test_un_usuario_puede_eliminar_un_item_del_carrito(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        $this->actingAs($user)->post("/carrito/{$product->id}", ['quantity' => 1]);
        $cartItem = $user->cart->items()->first();

        $response = $this->actingAs($user)->delete("/carrito/{$cartItem->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }
}
