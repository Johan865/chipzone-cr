<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('items.product')->latest()->paginate(10);

        return view('orders.index', ['orders' => $orders]);
    }

    public function confirmation(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        $order->load('items.product', 'payment');

        return view('orders.confirmation', ['order' => $order]);
    }
}
