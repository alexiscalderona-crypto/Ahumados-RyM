<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard(): View
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        $totalOrders = Order::count();
        $totalSales = Order::where('status', 'paid')->sum('total');
        $lowStock = Product::where('stock', '<', 10)->count();

        return view('admin.dashboard', compact('orders', 'totalOrders', 'totalSales', 'lowStock'));
    }
}
?>
