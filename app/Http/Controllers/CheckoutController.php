<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Payment;
use App\Services\CartService;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private PaymentGatewayService $paymentGateway,
    ) {
    }

    public function create(Request $request)
    {
        $cart = $this->cartService->getOrCreateCart($request->user());
        $cart->load('items.product');

        abort_if($cart->items->isEmpty(), 302, redirect()->route('cart.index')
            ->with('status', 'Tu carrito está vacío.')->getTargetUrl());

        return view('checkout.index', [
            'cart' => $cart,
            'summary' => $this->cartService->summary($cart),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_address' => ['required', 'string', 'max:255'],
            'payment_method' => ['required', 'in:credit_card,paypal'],
            'card_number' => ['required_if:payment_method,credit_card', 'nullable', 'string'],
        ]);

        $cart = $this->cartService->getOrCreateCart($request->user());
        $cart->load('items.product');

        abort_if($cart->items->isEmpty(), 400, 'El carrito está vacío.');

        $summary = $this->cartService->summary($cart);

        $order = DB::transaction(function () use ($request, $cart, $summary, $data) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'subtotal' => $summary['subtotal'],
                'tax' => $summary['tax'],
                'shipping_cost' => $summary['shipping_cost'],
                'total' => $summary['total'],
                'status' => 'pending',
                'shipping_address' => $data['shipping_address'],
                'tracking_number' => $this->paymentGateway->generateTrackingNumber(),
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                ]);
            }

            $result = $this->paymentGateway->charge($order, $data['payment_method'], $data);

            Payment::create([
                'order_id' => $order->id,
                'method' => $data['payment_method'],
                'amount' => $summary['total'],
                'status' => $result['status'],
                'gateway_reference' => $result['reference'],
            ]);

            $order->update(['status' => $result['success'] ? 'paid' : 'cancelled']);

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('orders.confirmation', $order)
            ->with('status', '¡Pedido confirmado!');
    }
}
