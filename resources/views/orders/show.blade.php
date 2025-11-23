<x-app-layout>
    <!-- Mobile App Style - Order Detail -->
    <div class="p-4 space-y-4">
        <!-- Header with Status -->
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('orders.index') }}" class="text-blue-600 text-sm font-medium">
                    ← Pesanan Saya
                </a>
                <h1 class="text-2xl font-bold text-gray-800 mt-1">Detail Pesanan</h1>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold
                {{ $order->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $order->status == 'siap_diambil' ? 'bg-green-100 text-green-800' : '' }}
                {{ $order->status == 'selesai' ? 'bg-gray-100 text-gray-800' : '' }}">
                {{ $order->getStatusLabel() }}
            </span>
        </div>


        <!-- Order Number Card -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-4 text-white">
            <p class="text-xs opacity-80 mb-1">Nomor Pesanan</p>
            <p class="text-2xl font-bold">{{ $order->order_number }}</p>
            <p class="text-xs opacity-80 mt-2">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
        </div>

        <!-- Order Info Grid -->
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white rounded-xl p-3 shadow-md">
                <div class="flex items-center space-x-2 mb-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-500">Total</p>
                </div>
                <p class="font-bold text-sm text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            </div>

            <div class="bg-white rounded-xl p-3 shadow-md">
                <div class="flex items-center space-x-2 mb-2">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-500">Bayar</p>
                </div>
                <p class="font-bold text-sm text-gray-800">{{ $order->payment_method == 'tunai' ? 'Tunai' : 'Tunai' }}</p>
            </div>
        </div>


        <!-- Order Items -->
        <div class="bg-white rounded-2xl p-4 shadow-md">
            <h2 class="font-semibold text-gray-800 mb-3">Pesanan Anda</h2>

            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center space-x-3 pb-3 border-b border-gray-100 last:border-0">
                        <img
                            src="{{ $item->product->image ? asset($item->product->image) : 'https://via.placeholder.com/60x60/3B82F6/FFFFFF?text=' . urlencode(substr($item->product->name, 0, 1)) }}"
                            alt="{{ $item->product->name }}"
                            class="w-16 h-16 object-cover rounded-lg"
                        >

                        <div class="flex-1">
                            <h3 class="font-semibold text-sm text-gray-800">{{ $item->product->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="font-bold text-sm text-gray-800">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach

                <div class="pt-3 border-t-2 border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-gray-800">Total</span>
                        <span class="font-bold text-lg text-blue-600">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status Timeline -->
        <div class="bg-white rounded-2xl p-4 shadow-md">
            <h2 class="font-semibold text-gray-800 mb-4">Tracking Pesanan</h2>


            <div class="relative space-y-6">
                <!-- Step 1: Menunggu -->
                <div class="flex items-start">
                    <div class="flex flex-col items-center mr-4">
                        <div class="w-10 h-10 rounded-full {{ $order->status != 'menunggu' ? 'bg-green-500' : 'bg-yellow-500' }} flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        @if($order->status != 'selesai')
                            <div class="w-0.5 h-12 {{ $order->status == 'menunggu' ? 'bg-gray-300' : 'bg-green-500' }}"></div>
                        @endif
                    </div>
                    <div class="flex-1 pb-6">
                        <p class="font-semibold text-sm text-gray-800">Pesanan Dibuat</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Step 2: Diproses -->
                <div class="flex items-start">
                    <div class="flex flex-col items-center mr-4">
                        <div class="w-10 h-10 rounded-full {{ $order->status == 'diproses' || $order->status == 'siap_diambil' || $order->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center shadow-md">
                            @if($order->status == 'diproses' || $order->status == 'siap_diambil' || $order->status == 'selesai')
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-white text-xs font-bold">2</span>
                            @endif
                        </div>
                        @if($order->status != 'selesai')
                            <div class="w-0.5 h-12 {{ $order->status == 'diproses' || $order->status == 'siap_diambil' || $order->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                        @endif
                    </div>
                    <div class="flex-1 pb-6">
                        <p class="font-semibold text-sm text-gray-800">Sedang Diproses</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $order->processed_at ? $order->processed_at->format('d M Y, H:i') : 'Belum diproses' }}
                        </p>
                    </div>
                </div>

                <!-- Step 3: Siap Diambil -->
                <div class="flex items-start">
                    <div class="flex flex-col items-center mr-4">
                        <div class="w-10 h-10 rounded-full {{ $order->status == 'siap_diambil' || $order->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center shadow-md">
                            @if($order->status == 'siap_diambil' || $order->status == 'selesai')
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-white text-xs font-bold">3</span>
                            @endif
                        </div>
                        @if($order->status != 'selesai')
                            <div class="w-0.5 h-12 {{ $order->status == 'siap_diambil' || $order->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                        @endif
                    </div>
                    <div class="flex-1 pb-6">
                        <p class="font-semibold text-sm text-gray-800">Siap Diambil</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $order->ready_at ? $order->ready_at->format('d M Y, H:i') : 'Belum siap' }}
                        </p>
                    </div>
                </div>

                <!-- Step 4: Selesai -->
                <div class="flex items-start">
                    <div class="flex flex-col items-center mr-4">
                        <div class="w-10 h-10 rounded-full {{ $order->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center shadow-md">
                            @if($order->status == 'selesai')
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <span class="text-white text-xs font-bold">4</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800">Selesai</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $order->completed_at ? $order->completed_at->format('d M Y, H:i') : 'Belum selesai' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Notice -->
        @if($order->status == 'siap_diambil')
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-green-800">Pesanan Siap Diambil!</p>
                        <p class="text-xs text-green-700 mt-1">
                            Pesanan Anda sudah siap. Silakan datang ke kantin dan tunjukkan nomor pesanan untuk mengambil pesanan.
                        </p>
                    </div>
                </div>
            </div>
        @elseif($order->status == 'menunggu')
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-yellow-800">Menunggu Konfirmasi</p>
                        <p class="text-xs text-yellow-700 mt-1">
                            Pesanan Anda sedang menunggu untuk diproses oleh tim kantin. Harap bersabar.
                        </p>
                    </div>
                </div>
            </div>
        @elseif($order->status == 'diproses')
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-blue-800">Sedang Diproses</p>
                        <p class="text-xs text-blue-700 mt-1">
                            Pesanan Anda sedang disiapkan oleh tim kantin. Mohon menunggu sebentar.
                        </p>
                    </div>
                </div>
            </div>
        @elseif($order->status == 'selesai')
            <div class="bg-gray-50 border-l-4 border-gray-500 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-gray-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Pesanan Selesai</p>
                        <p class="text-xs text-gray-700 mt-1">
                            Terima kasih telah memesan! Pesanan Anda telah selesai.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>