<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        // Order Statistics
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'menunggu')->count();
        $processedOrders = Order::where('status', 'diproses')->count();
        $readyOrders = Order::where('status', 'siap_diambil')->count();
        $completedOrders = Order::where('status', 'selesai')->count();

        // Revenue Statistics
        $totalRevenue = Order::where('status', 'selesai')->sum('total_amount');
        $todayRevenue = Order::where('status', 'selesai')
                            ->whereDate('created_at', today())
                            ->sum('total_amount');

        // Product Statistics
        $totalProducts = Product::count();
        $availableProducts = Product::where('is_available', true)->count();
        $outOfStock = Product::where('stock', '<=', 0)->count();

        // User Statistics
        $totalUsers = \App\Models\User::where('role', 'student')->count();

        // Recent Orders
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(10)->get();

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '>', 0)
                                  ->where('stock', '<=', 10)
                                  ->orderBy('stock', 'asc')
                                  ->take(5)
                                  ->get();

        return view('dashboard.admin', compact(
            'totalOrders',
            'pendingOrders',
            'processedOrders',
            'readyOrders',
            'completedOrders',
            'totalRevenue',
            'todayRevenue',
            'totalProducts',
            'availableProducts',
            'outOfStock',
            'totalUsers',
            'recentOrders',
            'lowStockProducts'
        ));
    }

    private function studentDashboard()
    {
        $user = Auth::user();

        // Ambil pesanan terakhir untuk user ini
        $userOrders = Order::where('user_id', $user->id)
                          ->orderBy('created_at', 'desc')
                          ->with('orderItems.product') // Load produk untuk ditampilkan di daftar pesanan
                          ->paginate(5); // Menampilkan hanya 5 pesanan terbaru

        // Hitung jumlah pesanan menunggu dan siap diambil untuk ditampilkan di quick stats
        $pendingOrders = Order::where('user_id', $user->id)
                             ->where('status', 'menunggu')
                             ->count();

        $readyOrders = Order::where('user_id', $user->id)
                           ->whereIn('status', ['siap_diambil', 'diproses'])
                           ->count();

        return view('dashboard.student', compact('userOrders', 'pendingOrders', 'readyOrders'));
    }
}