<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_usuario_puede_completar_el_checkout_y_genera_pedido_con_seguimiento(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Audio', 'slug' => 'audio']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Parlante Demo',
            'slug' => 'parlante-demo',
            'price' => 20000,
            'stock' => 5,
        ]);

        $this->actingAs($user)->post("/carrito/{$product->id}", ['quantity' => 1]);

        $response = $this->actingAs($user)->post('/checkout', [
            'shipping_address' => 'San José, Costa Rica',
            'payment_method' => 'credit_card',
            'card_number' => '4111111111111111',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'status' => 'paid']);
        $this->assertDatabaseCount('cart_items', 0);

        $order = $user->orders()->first();
        $this->assertNotNull($order->tracking_number);
        $this->assertDatabaseHas('payments', ['order_id' => $order->id, 'status' => 'completed']);
    }

    public function test_no_se_puede_ir_a_pagar_con_el_carrito_vacio(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/checkout');

        $response->assertRedirect(route('cart.index'));
    }
}
