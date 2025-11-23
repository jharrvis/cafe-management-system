<x-app-layout>
    <div class="p-4 space-y-4 mb-20">
        <!-- Back Button & Header -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.orders.index') }}" class="p-2 bg-white rounded-full shadow-md">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800">Detail Pesanan</h2>
                <p class="text-sm text-gray-500">{{ $order->order_number }}</p>
            </div>
        </div>

        <!-- Success/Error Message -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Order Status Card -->
        <div class="bg-gradient-to-br
            {{ $order->is_cancelled ? 'from-red-500 to-pink-600' : '' }}
            {{ !$order->is_cancelled && $order->status == 'menunggu' ? 'from-yellow-500 to-orange-500' : '' }}
            {{ !$order->is_cancelled && $order->status == 'diproses' ? 'from-blue-500 to-indigo-600' : '' }}
            {{ !$order->is_cancelled && $order->status == 'siap_diambil' ? 'from-green-500 to-teal-600' : '' }}
            {{ !$order->is_cancelled && $order->status == 'selesai' ? 'from-gray-500 to-gray-700' : '' }}
            rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-white text-opacity-90 text-sm mb-1">Status Pesanan</p>
                    <h3 class="text-2xl font-bold">
                        @if($order->is_cancelled)
                            Dibatalkan
                        @else
                            {{ $order->status == 'menunggu' ? 'Menunggu' : ($order->status == 'diproses' ? 'Diproses' : ($order->status == 'siap_diambil' ? 'Siap Diantar' : 'Selesai')) }}
                        @endif
                    </h3>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    @if($order->is_cancelled)
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    @elseif($order->status == 'selesai')
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    @else
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-between text-sm">
                <span class="text-white text-opacity-80">Total Pembayaran</span>
                <span class="text-2xl font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Cancellation Info (if cancelled) -->
        @if($order->is_cancelled)
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-red-800">Pesanan Dibatalkan</p>
                        <p class="text-xs text-red-700 mt-1">{{ $order->cancellation_reason }}</p>
                        <p class="text-xs text-red-600 mt-1">{{ $order->cancelled_at?->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Status Update (if not cancelled and not completed) -->
        @if(!$order->is_cancelled && $order->status != 'selesai')
            <div class="bg-white rounded-2xl p-4 shadow-md">
                <h3 class="font-semibold text-gray-800 mb-3 text-sm">Update Status Cepat</h3>
                <div class="grid grid-cols-2 gap-2">
                    @if($order->status == 'menunggu')
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="diproses">
                            <button type="submit" class="w-full px-3 py-2 bg-blue-500 text-white rounded-xl text-sm font-medium hover:bg-blue-600 transition">
                                Proses Pesanan
                            </button>
                        </form>
                        <button onclick="document.getElementById('cancelModal').classList.remove('hidden')" class="px-3 py-2 bg-red-500 text-white rounded-xl text-sm font-medium hover:bg-red-600 transition">
                            Batalkan
                        </button>
                    @endif

                    @if($order->status == 'diproses')
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="siap_diambil">
                            <button type="submit" class="w-full px-3 py-2 bg-green-500 text-white rounded-xl text-sm font-medium hover:bg-green-600 transition">
                                Siap Diantar
                            </button>
                        </form>
                        <button onclick="document.getElementById('cancelModal').classList.remove('hidden')" class="px-3 py-2 bg-red-500 text-white rounded-xl text-sm font-medium hover:bg-red-600 transition">
                            Batalkan
                        </button>
                    @endif

                    @if($order->status == 'siap_diambil')
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="col-span-2">
                            @csrf
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit" class="w-full px-3 py-2 bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-xl text-sm font-medium hover:shadow-lg transition">
                                Selesaikan Pesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endif

        <!-- Customer Information -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi Pelanggan
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nama:</span>
                    <span class="font-medium text-gray-900">{{ $order->user->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-medium text-gray-900 truncate ml-2">{{ $order->user->email }}</span>
                </div>
                @if($order->user->nisn)
                <div class="flex justify-between">
                    <span class="text-gray-600">NISN:</span>
                    <span class="font-medium text-gray-900">{{ $order->user->nisn }}</span>
                </div>
                @endif
                <div class="flex justify-between pt-2 border-t">
                    <span class="text-gray-600">Tanggal Pesanan:</span>
                    <span class="font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Item Pesanan ({{ $order->orderItems->count() }})
            </h3>
            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-xl {{ $item->is_cancelled ? 'opacity-50' : '' }}">
                        @if($item->product && $item->product->image)
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-gray-900">{{ $item->product->name ?? 'Produk tidak tersedia' }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $item->product->category->name ?? '' }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                <span class="text-sm font-bold text-blue-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                            @if($item->is_cancelled)
                                <div class="mt-2 pt-2 border-t border-gray-200">
                                    <p class="text-xs text-red-600 font-medium">Dibatalkan: {{ $item->cancellation_reason }}</p>
                                </div>
                            @elseif(!$order->is_cancelled && $order->status != 'selesai')
                                <button onclick="openCancelItemModal({{ $item->id }}, '{{ $item->product->name }}')" class="mt-2 text-xs text-red-600 hover:text-red-800 font-medium">
                                    Batalkan item ini
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="mt-4 pt-4 border-t-2 border-gray-200">
                <div class="flex justify-between items-center">
                    <span class="text-base font-semibold text-gray-900">Total Pembayaran</span>
                    <span class="text-xl font-bold text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Order Information -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informasi Pesanan
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">No. Pesanan:</span>
                    <span class="font-medium text-gray-900">{{ $order->order_number }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Metode Pembayaran:</span>
                    <span class="font-medium text-gray-900">{{ ucfirst($order->payment_method) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Item:</span>
                    <span class="font-medium text-gray-900">{{ $order->orderItems->sum('quantity') }} item</span>
                </div>
                @if($order->completed_at)
                <div class="flex justify-between">
                    <span class="text-gray-600">Diselesaikan:</span>
                    <span class="font-medium text-gray-900">{{ $order->completed_at->format('d M Y, H:i') }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Cancel Order Modal -->
    <div id="cancelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Batalkan Pesanan</h3>
            <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Pembatalan *</label>
                    <textarea name="reason" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Contoh: Stok habis, pelanggan membatalkan, dll"></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="document.getElementById('cancelModal').classList.add('hidden')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition">
                        Batalkan Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancel Item Modal -->
    <div id="cancelItemModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Batalkan Item</h3>
            <p class="text-sm text-gray-600 mb-4" id="itemName"></p>
            <form id="cancelItemForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Pembatalan *</label>
                    <textarea name="reason" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Contoh: Stok habis, bahan tidak tersedia, dll"></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="document.getElementById('cancelItemModal').classList.add('hidden')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition">
                        Batalkan Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCancelItemModal(itemId, itemName) {
            document.getElementById('itemName').textContent = itemName;
            document.getElementById('cancelItemForm').action = `/admin/orders/items/${itemId}/cancel`;
            document.getElementById('cancelItemModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>
