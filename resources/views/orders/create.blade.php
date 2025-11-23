<x-app-layout>
    <!-- Mobile App Style - Checkout -->
    <div class="p-4 space-y-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Checkout</h1>
            <a href="{{ route('cart.index') }}" class="text-blue-600 text-sm font-medium">
                ← Kembali
            </a>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl p-4 shadow-md">
            <h2 class="font-semibold text-gray-800 mb-3">Ringkasan Pesanan</h2>

            <div class="space-y-3">
                @foreach($cartItems as $item)
                    <div class="flex items-center space-x-3 pb-3 border-b border-gray-100 last:border-0">
                        <img
                            src="{{ $item['product']->image ? asset($item['product']->image) : 'https://via.placeholder.com/60x60/3B82F6/FFFFFF?text=' . urlencode(substr($item['product']->name, 0, 1)) }}"
                            alt="{{ $item['product']->name }}"
                            class="w-16 h-16 object-cover rounded-lg"
                        >

                        <div class="flex-1">
                            <h3 class="font-semibold text-sm text-gray-800">{{ $item['product']->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                Rp {{ number_format($item['product']->price, 0, ',', '.') }} × {{ $item['quantity'] }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="font-bold text-sm text-gray-800">
                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- User Info -->
        <div class="bg-white rounded-2xl p-4 shadow-md">
            <h2 class="font-semibold text-gray-800 mb-3">Info Pemesan</h2>

            <div class="space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Nama</p>
                        <p class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Email</p>
                        <p class="font-medium text-sm text-gray-800">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Alamat</p>
                        <p class="font-medium text-sm text-gray-800">{{ Auth::user()->alamat ?? 'Alamat belum diisi' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="bg-white rounded-2xl p-4 shadow-md">
            <h2 class="font-semibold text-gray-800 mb-3">Metode Pembayaran</h2>

            <form action="{{ route('orders.store') }}" method="POST" id="checkoutForm">
                @csrf

                <div class="space-y-2">
                    <label class="flex items-center space-x-3 p-3 bg-blue-50 border-2 border-blue-500 rounded-xl cursor-pointer">
                        <input type="radio" name="payment_method" value="tunai" checked class="w-5 h-5 text-blue-600">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="font-medium text-sm text-gray-800">COD - Cash on Delivery</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 ml-7">Bayar langsung saat menerima pesanan</p>
                        </div>
                    </label>
                </div>
            </form>
        </div>

        <!-- Total Summary -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-4 text-white">
            <div class="flex justify-between items-center mb-3">
                <span class="text-sm opacity-90">Subtotal</span>
                <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center mb-3">
                <span class="text-sm opacity-90">Pajak & Biaya</span>
                <span class="font-semibold">Rp 0</span>
            </div>
            <div class="border-t border-white border-opacity-30 pt-3">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold">Total Bayar</span>
                    <span class="text-2xl font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Info Notice -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-yellow-800">Informasi Penting</p>
                    <p class="text-xs text-yellow-700 mt-1">
                        Pesanan akan diproses setelah Anda klik tombol "Proses Pesanan".
                        Harap siapkan uang pas saat mengambil pesanan di kantin.
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <button
            type="submit"
            form="checkoutForm"
            class="w-full py-4 bg-gradient-to-r from-green-500 to-teal-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-teal-700 transition-all shadow-lg"
        >
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Proses Pesanan
        </button>
    </div>
</x-app-layout>