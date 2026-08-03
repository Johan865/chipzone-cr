<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    public function index(Request $request)
    {
        $cart = $this->cartService->getOrCreateCart($request->user());
        $cart->load('items.product');

        return view('cart.index', [
            'cart' => $cart,
            'summary' => $this->cartService->summary($cart),
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate(['quantity' => ['nullable', 'integer', 'min:1']]);

        $cart = $this->cartService->getOrCreateCart($request->user());
        $this->cartService->addProduct($cart, $product->id, $data['quantity'] ?? 1);

        return back()->with('status', 'Producto agregado al carrito.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeItem($request, $cartItem);

        $data = $request->validate(['quantity' => ['required', 'integer', 'min:0']]);

        $this->cartService->updateQuantity($cartItem->cart, $cartItem->id, $data['quantity']);

        return back()->with('status', 'Carrito actualizado.');
    }

    public function destroy(Request $request, CartItem $cartItem)
    {
        $this->authorizeItem($request, $cartItem);

        $this->cartService->removeItem($cartItem->cart, $cartItem->id);

        return back()->with('status', 'Producto eliminado del carrito.');
    }

    private function authorizeItem(Request $request, CartItem $cartItem): void
    {
        abort_unless($cartItem->cart->user_id === $request->user()->id, 403);
    }
}
