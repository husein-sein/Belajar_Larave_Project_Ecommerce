<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Show checkout page
    public function checkout(Request $request)
    {
        $itemIds = $request->input('items', []);
        
        if (empty($itemIds)) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu produk untuk di-checkout.');
        }

        // Fetch selected cart items
        $cartItems = CartItem::whereHas('cart', function ($q) {
            $q->where('user_id', Auth::id());
        })->whereIn('id', $itemIds)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak valid.');
        }

        $paymentMethods = PaymentMethod::all();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'paymentMethods', 'total', 'itemIds'));
    }

    // Process checkout
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:cart_items,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_address' => 'required|string',
        ]);

        $cartItems = CartItem::whereHas('cart', function ($q) {
            $q->where('user_id', Auth::id());
        })->whereIn('id', $request->items)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak valid.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'payment_method_id' => $request->payment_method_id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'total_price' => $total,
            'shipping_address' => $request->shipping_address,
            'status' => 'pending',
        ]);

        // Create Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // Remove from cart
            $item->delete();
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.');
    }

    // User's order history
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product', 'paymentMethod'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders', compact('orders'));
    }

    // User mark order as completed (Sudah Sampai)
    public function complete($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dikirim atau sudah diselesaikan.');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pesanan telah diselesaikan. Terima kasih!');
    }
}
