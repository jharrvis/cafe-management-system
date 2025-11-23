<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang belanja kosong');
        }

        // Get product details for items in cart
        $cartItems = [];
        $total = 0;
        
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $details['quantity'] * $details['price']
                ];
                $total += $details['quantity'] * $details['price'];
            }
        }

        return view('orders.create', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang belanja kosong');
        }

        // Generate unique order number
        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Calculate total
        $total = 0;
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product && $product->is_available && $product->stock >= $details['quantity']) {
                $total += $details['quantity'] * $details['price'];
            } else {
                return redirect()->back()->with('error', 'Produk tidak tersedia atau stok tidak mencukupi');
            }
        }

        // Create order
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'status' => 'menunggu',
            'total_amount' => $total,
            'payment_method' => 'tunai',
            'ordered_at' => now(),
        ]);

        // Create order items and decrease stock
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'subtotal' => $details['quantity'] * $details['price'],
                ]);

                // Decrease stock
                $product->decrement('stock', $details['quantity']);
            }
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $orderNumber);
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        
        if ($order->user_id != Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        return view('orders.show', compact('order'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if (!$product->is_available) {
            return redirect()->back()->with('error', 'Produk tidak tersedia');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] + $request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi');
            }
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            if ($request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi');
            }
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if ($request->has('quantities')) {
            foreach ($request->quantities as $id => $quantity) {
                if ($quantity <= 0) {
                    unset($cart[$id]);
                } else {
                    $product = Product::find($id);
                    if ($product && $quantity <= $product->stock) {
                        $cart[$id]['quantity'] = $quantity;
                    } else {
                        return redirect()->back()->with('error', 'Stok tidak mencukupi untuk ' . ($product ? $product->name : 'produk'));
                    }
                }
            }
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $details['quantity'] * $details['price']
                ];
                $total += $details['quantity'] * $details['price'];
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Admin Methods
    public function adminIndex(Request $request)
    {
        $query = Order::with(['user', 'orderItems']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        // Search by order number or user name
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $orders = $query->latest()->paginate(20);

        // Statistics
        $stats = [
            'total' => Order::count(),
            'menunggu' => Order::where('status', 'menunggu')->count(),
            'diproses' => Order::where('status', 'diproses')->count(),
            'siap_diambil' => Order::where('status', 'siap_diambil')->count(),
            'selesai' => Order::where('status', 'selesai')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    public function adminShow($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,diproses,siap_diambil,selesai',
        ]);

        $order->status = $request->status;

        if ($request->status == 'selesai') {
            $order->completed_at = now();
        }

        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Cancel an entire order
     */
    public function cancelOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate that order is not already cancelled or completed
        if ($order->is_cancelled) {
            return redirect()->back()->with('error', 'Pesanan sudah dibatalkan sebelumnya');
        }

        if ($order->status == 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat membatalkan pesanan yang sudah selesai');
        }

        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        // Mark order as cancelled
        $order->is_cancelled = true;
        $order->cancellation_reason = $request->reason;
        $order->cancelled_at = now();
        $order->save();

        // Return stock for all items
        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dibatalkan dan stok dikembalikan');
    }

    /**
     * Cancel a single order item
     */
    public function cancelOrderItem(Request $request, $itemId)
    {
        $orderItem = OrderItem::findOrFail($itemId);
        $order = $orderItem->order;

        // Validate that order is not cancelled or completed
        if ($order->is_cancelled) {
            return redirect()->back()->with('error', 'Tidak dapat membatalkan item dari pesanan yang sudah dibatalkan');
        }

        if ($order->status == 'selesai') {
            return redirect()->back()->with('error', 'Tidak dapat membatalkan item dari pesanan yang sudah selesai');
        }

        if ($orderItem->is_cancelled) {
            return redirect()->back()->with('error', 'Item sudah dibatalkan sebelumnya');
        }

        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        // Mark item as cancelled
        $orderItem->is_cancelled = true;
        $orderItem->cancellation_reason = $request->reason;
        $orderItem->cancelled_at = now();
        $orderItem->save();

        // Return stock for this item
        if ($orderItem->product) {
            $orderItem->product->increment('stock', $orderItem->quantity);
        }

        // Recalculate order total (excluding cancelled items)
        $newTotal = $order->orderItems()
            ->where('is_cancelled', false)
            ->sum('subtotal');

        $order->total_amount = $newTotal;
        $order->save();

        // If all items are cancelled, cancel the entire order
        $allCancelled = $order->orderItems()->where('is_cancelled', false)->count() == 0;
        if ($allCancelled) {
            $order->is_cancelled = true;
            $order->cancellation_reason = 'Semua item dibatalkan';
            $order->cancelled_at = now();
            $order->save();
        }

        return redirect()->back()->with('success', 'Item berhasil dibatalkan dan stok dikembalikan. Total pesanan diperbarui.');
    }
}