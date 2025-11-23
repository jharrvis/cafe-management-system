<x-app-layout>
    <!-- Mobile App Style - My Orders -->
    <div class="p-4 space-y-4">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Pesanan Saya</h1>
            <p class="text-sm text-gray-500 mt-1">Riwayat semua pesanan Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-3">
                <p class="text-sm text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        @if($orders && count($orders) > 0)
            <!-- Orders List -->
            <div class="space-y-3">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order->id) }}" class="block">
                        <div class="bg-white rounded-2xl p-4 shadow-md hover:shadow-lg transition-all">
                            <!-- Order Header -->
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <p class="text-xs text-gray-500">Nomor Pesanan</p>
                                    <p class="font-bold text-sm text-gray-800">{{ $order->order_number }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $order->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status == 'siap_diambil' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status == 'selesai' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ $order->getStatusLabel() }}
                                </span>
                            </div>

                            <!-- Order Items Preview -->
                            <div class="flex items-center space-x-2 mb-3">
                                @foreach($order->orderItems->take(3) as $item)
                                    <img
                                        src="{{ $item->product->image ? asset($item->product->image) : 'https://via.placeholder.com/40x40/3B82F6/FFFFFF?text=' . urlencode(substr($item->product->name, 0, 1)) }}"
                                        alt="{{ $item->product->name }}"
                                        class="w-10 h-10 object-cover rounded-lg border-2 border-white shadow-sm"
                                    >
                                @endforeach
                                @if($order->orderItems->count() > 3)
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <span class="text-xs font-bold text-gray-600">+{{ $order->orderItems->count() - 3 }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Order Info -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-500">Total Pembayaran</p>
                                    <p class="font-bold text-sm text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Tanggal Pesan</p>
                                    <p class="font-medium text-sm text-gray-800">{{ $order->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            <!-- Action Hint -->
                            <div class="mt-3 flex items-center justify-center text-blue-600">
                                <span class="text-xs font-medium">Lihat Detail</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-16">
                <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500 text-center mb-6 px-8">
                    Anda belum pernah melakukan pemesanan.<br>
                    Yuk, mulai pesan makanan favoritmu!
                </p>
                <a
                    href="{{ route('products.index') }}"
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all shadow-lg"
                >
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
