<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        
        $latestOrders = Order::with('user')->latest()->take(5)->get();
        $allUsers = User::where('role', 'user')->get();
        $allProducts = Product::all();

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalProducts', 'totalUsers', 'latestOrders', 'allUsers', 'allProducts'));
    }

    public function assignProduct(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        
        $order = Order::create([
            'user_id' => $request->user_id,
            'order_number' => 'ORD-' . strtoupper(str()->random(8)),
            'total_price' => $product->price * $request->quantity,
            'status' => 'completed',
            'payment_method_id' => 1,
            'shipping_address' => 'Assigned by Admin',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price,
        ]);

        return back()->with('success', 'Berhasil menambahkan barang ke user!');
    }

    public function products()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function approveOrder(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:processing,shipped',
        ]);

        $order = Order::findOrFail($id);
        
        $updateData = ['status' => $request->status];
        
        if ($request->status === 'shipped') {
            $updateData['estimated_delivery_date'] = Carbon::now()->addDays(rand(2, 4));
        }
        
        $order->update($updateData);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function admins()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins', compact('admins'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return back()->with('success', 'Admin berhasil ditambahkan!');
    }
}
