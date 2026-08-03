<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;

class CartService
{
    // IVA en Costa Rica = 13%
    private const TAX_RATE = 0.13;

    // Envío gratis a partir de este monto de subtotal
    private const FREE_SHIPPING_THRESHOLD = 100000;
    private const FLAT_SHIPPING_COST = 3500;

    public function getOrCreateCart(User $user): Cart
    {
        return Cart::firstOrCreate(['user_id' => $user->id]);
    }

    public function addProduct(Cart $cart, int $productId, int $quantity = 1): void
    {
        $item = $cart->items()->firstOrNew(['product_id' => $productId]);
        $item->quantity = ($item->exists ? $item->quantity : 0) + $quantity;
        $item->save();
    }

    public function updateQuantity(Cart $cart, int $cartItemId, int $quantity): void
    {
        $item = $cart->items()->findOrFail($cartItemId);

        if ($quantity <= 0) {
            $item->delete();
            return;
        }

        $item->update(['quantity' => $quantity]);
    }

    public function removeItem(Cart $cart, int $cartItemId): void
    {
        $cart->items()->findOrFail($cartItemId)->delete();
    }

    public function subtotal(Cart $cart): float
    {
        return $cart->items->sum(fn ($item) => $item->subtotal());
    }

    public function tax(Cart $cart): float
    {
        return round($this->subtotal($cart) * self::TAX_RATE, 2);
    }

    public function shippingCost(Cart $cart): float
    {
        return $this->subtotal($cart) >= self::FREE_SHIPPING_THRESHOLD
            ? 0.0
            : self::FLAT_SHIPPING_COST;
    }

    public function total(Cart $cart): float
    {
        return round($this->subtotal($cart) + $this->tax($cart) + $this->shippingCost($cart), 2);
    }

    public function summary(Cart $cart): array
    {
        return [
            'subtotal' => $this->subtotal($cart),
            'tax' => $this->tax($cart),
            'shipping_cost' => $this->shippingCost($cart),
            'total' => $this->total($cart),
        ];
    }
}
