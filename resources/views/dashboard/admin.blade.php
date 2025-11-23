<x-app-layout>
    <!-- Admin Dashboard - Mobile App Style -->
    <div class="p-4 space-y-4">

        <!-- Welcome Card -->
        <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Admin Dashboard</h2>
                    <p class="text-white text-opacity-90">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-white text-opacity-80 mt-1">Selamat datang kembali!</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Revenue Cards -->
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl p-4 text-white shadow-md">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-xs opacity-90">Total Pendapatan</span>
                </div>
                <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-4 text-white shadow-md">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span class="text-xs opacity-90">Hari Ini</span>
                </div>
                <p class="text-2xl font-bold">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-2 gap-3">
            <!-- Total Orders -->
            <div class="bg-white rounded-2xl p-4 shadow-md">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-500 text-xs">Total Pesanan</p>
                <h3 class="text-xl font-bold text-gray-800 mt-1">{{ $totalOrders }}</h3>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-2xl p-4 shadow-md">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-500 text-xs">Menunggu</p>
                <h3 class="text-xl font-bold text-yellow-600 mt-1">{{ $pendingOrders }}</h3>
            </div>

            <!-- Processing Orders -->
            <div class="bg-white rounded-2xl p-4 shadow-md">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-500 text-xs">Diproses</p>
                <h3 class="text-xl font-bold text-blue-600 mt-1">{{ $processedOrders }}</h3>
            </div>

            <!-- Ready Orders -->
            <div class="bg-white rounded-2xl p-4 shadow-md">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-500 text-xs">Siap Diambil</p>
                <h3 class="text-xl font-bold text-green-600 mt-1">{{ $readyOrders }}</h3>
            </div>

            <!-- Total Products -->
            <div class="bg-white rounded-2xl p-4 shadow-md">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h15v12c0 1.657-1.343 3-3 3H6c-1.657 0-3-1.343-3-3V3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 8h1c1.105 0 2 .895 2 2v2c0 1.105-.895 2-2 2h-1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 21h12"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-500 text-xs">Total Produk</p>
                <h3 class="text-xl font-bold text-gray-800 mt-1">{{ $totalProducts }}</h3>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-2xl p-4 shadow-md">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-500 text-xs">Total Siswa</p>
                <h3 class="text-xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</h3>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-4 gap-3">
                <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-600 text-center">Tambah Produk</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-600 text-center">Kelola Pesanan</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-600 text-center">Kelola Produk</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center space-y-2 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-600 text-center">Kategori</span>
                </a>
            </div>
        </div>

        <!-- Low Stock Alert -->
        @if($lowStockProducts->count() > 0)
        <div class="bg-orange-50 border-l-4 border-orange-500 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-orange-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-bold text-orange-800">Peringatan Stok Rendah!</p>
                    <p class="text-xs text-orange-700 mt-1">{{ $lowStockProducts->count() }} produk memiliki stok rendah</p>
                    <div class="mt-2 space-y-1">
                        @foreach($lowStockProducts as $product)
                        <div class="flex justify-between text-xs">
                            <span class="text-orange-800">{{ $product->name }}</span>
                            <span class="font-bold text-orange-900">Stok: {{ $product->stock }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-800">Pesanan Terbaru</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 font-medium">Lihat Semua</a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="space-y-3">
                    @foreach($recentOrders as $order)
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="block">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                            <div class="flex-1">
                                <p class="font-semibold text-sm text-gray-800">{{ $order->order_number }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $order->user->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-sm text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                <span class="inline-block mt-1 px-2 py-1 rounded-full text-[10px] font-bold
                                    {{ $order->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status == 'siap_diambil' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status == 'selesai' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ $order->getStatusLabel() }}
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
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
