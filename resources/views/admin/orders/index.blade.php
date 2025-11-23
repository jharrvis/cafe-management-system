<x-app-layout>
    <div class="p-4 space-y-4 mb-20">
        <!-- Header -->
        <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2">Manajemen Pesanan</h2>
            <p class="text-white text-opacity-90 text-sm">Kelola dan pantau semua pesanan pelanggan</p>
        </div>

        <!-- Success Message -->
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

        <!-- Statistics Cards - Mobile Compact -->
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white rounded-xl p-4 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Total</p>
                        <p class="text-xl font-bold text-gray-900 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl p-4 shadow-md text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-white text-opacity-90">Menunggu</p>
                        <p class="text-xl font-bold mt-1">{{ $stats['menunggu'] }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl p-4 shadow-md text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-white text-opacity-90">Diproses</p>
                        <p class="text-xl font-bold mt-1">{{ $stats['diproses'] }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-xl p-4 shadow-md text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-white text-opacity-90">Siap Diambil</p>
                        <p class="text-xl font-bold mt-1">{{ $stats['siap_diambil'] }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters - Compact -->
        <div class="bg-white rounded-2xl p-4 shadow-md">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="siap_diambil" {{ request('status') == 'siap_diambil' ? 'selected' : '' }}>Siap Diambil</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div>
                        <input type="date" name="date" value="{{ request('date') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no. pesanan atau nama..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-medium shadow-md hover:shadow-lg transition">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Filter
                </button>
            </form>
        </div>

        <!-- Orders List - Card Style for Mobile -->
        <div class="space-y-3">
            @forelse($orders as $order)
                <a href="{{ route('admin.orders.show', $order->id) }}" class="block bg-white rounded-2xl p-4 shadow-md hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $order->user->name }}</p>
                        </div>
                        <span class="ml-2 px-2 py-1 inline-flex text-[10px] leading-tight font-bold rounded-full flex-shrink-0
                            {{ $order->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $order->status == 'siap_diambil' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $order->status == 'selesai' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $order->is_cancelled ? 'bg-red-100 text-red-800' : '' }}">
                            @if($order->is_cancelled)
                                Dibatalkan
                            @else
                                {{ $order->status == 'menunggu' ? 'Menunggu' : ($order->status == 'diproses' ? 'Diproses' : ($order->status == 'siap_diambil' ? 'Siap Diambil' : 'Selesai')) }}
                            @endif
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 text-xs text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $order->created_at->format('d/m H:i') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                {{ $order->orderItems->count() }} item
                            </div>
                        </div>
                        <p class="text-sm font-bold text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </a>
            @empty
                <div class="bg-white rounded-2xl p-12 text-center text-gray-400 shadow-md">
                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-sm">Tidak ada pesanan ditemukan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="bg-white rounded-2xl p-4 shadow-md">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
