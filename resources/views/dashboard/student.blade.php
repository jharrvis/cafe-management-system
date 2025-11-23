<x-app-layout>
    <!-- Student Dashboard - Mobile App Style -->
    <div class="p-4 space-y-4">

        <!-- Welcome Card -->
        <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
            <p class="text-white text-opacity-90">{{ Auth::user()->name }}</p>
            <p class="text-sm text-white text-opacity-80 mt-1">{{ Auth::user()->email }}</p>
            @if(Auth::user()->username)
                <p class="text-xs text-white text-opacity-70 mt-1">Username: {{ Auth::user()->username }}</p>
            @endif
            @if(Auth::user()->nisn)
                <p class="text-xs text-white text-opacity-70 mt-1">NISN: {{ Auth::user()->nisn }}</p>
            @endif
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl p-4 text-white shadow-md">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-xs opacity-90">Pesanan Menunggu</span>
                </div>
                <p class="text-2xl font-bold">{{ $pendingOrders ?? 0 }}</p>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl p-4 text-white shadow-md">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span class="text-xs opacity-90">Siap Diambil</span>
                </div>
                <p class="text-2xl font-bold">{{ $readyOrders ?? 0 }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4">Menu Cepat</h3>
            <div class="grid grid-cols-4 gap-3">
                <a href="{{ route('products.index') }}" class="flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h15v12c0 1.657-1.343 3-3 3H6c-1.657 0-3-1.343-3-3V3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 8h1c1.105 0 2 .895 2 2v2c0 1.105-.895 2-2 2h-1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21h12"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-600 text-center">Pesan Makanan</span>
                </a>

                <a href="{{ route('cart.index') }}" class="relative flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center relative">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-600 text-center">Keranjang</span>
                </a>

                <a href="{{ route('orders.index') }}" class="flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-600 text-center">Riwayat Pesanan</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-600 text-center">Profil Saya</span>
                </a>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-800">Pesanan Terbaru</h3>
                <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 font-medium">Lihat Semua</a>
            </div>

            @if(isset($userOrders) && $userOrders->count() > 0)
                <div class="space-y-3">
                    @foreach($userOrders as $order)
                    <a href="{{ route('orders.show', $order->id) }}" class="block">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                            <div class="flex-1">
                                <p class="font-semibold text-sm text-gray-800">{{ $order->order_number }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-sm text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                <span class="inline-block mt-1 px-2 py-1 rounded-full text-[10px] font-bold
                                    {{ $order->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status == 'siap_diambil' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status == 'selesai' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{
                                        $order->status == 'menunggu' ? 'Menunggu' :
                                        ($order->status == 'diproses' ? 'Diproses' :
                                        ($order->status == 'siap_diambil' ? 'Siap Diambil' : 'Selesai'))
                                    }}
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-sm">Belum ada pesanan</p>
                    <a href="{{ route('products.index') }}" class="mt-2 inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-xs hover:bg-blue-700">
                        Buat Pesanan Baru
                    </a>
                </div>
            @endif
        </div>

        <!-- Info Card -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-xl p-5 shadow-sm">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Cara Pesan Makanan</h3>
                    <ol class="text-sm text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">1</span>
                            <span><strong>Klik "Pesan Makanan"</strong> untuk melihat menu yang tersedia</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">2</span>
                            <span><strong>Pilih makanan/minuman</strong> yang kamu inginkan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">3</span>
                            <span><strong>Tambahkan ke keranjang</strong> dan periksa kembali pesananmu</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">4</span>
                            <span><strong>Checkout dengan metode COD</strong> - Bayar saat pesanan sampai di alamatmu</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">5</span>
                            <span><strong>Pesanan akan diantar</strong> ke alamat yang terdaftar sesuai jadwal pengiriman</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>