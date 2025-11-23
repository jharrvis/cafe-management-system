<x-app-layout>
    <!-- Mobile App Style - Keranjang Belanja -->
    <div class="p-4 space-y-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Keranjang</h1>
            <a href="{{ route('products.index') }}" class="text-blue-600 text-sm font-medium">
                + Tambah Menu
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems && count($cartItems) > 0)
            <!-- Cart Items -->
            <div class="space-y-3">
                @foreach($cartItems as $item)
                    <div class="bg-white rounded-2xl p-4 shadow-md">
                        <div class="flex items-center space-x-3">
                            <!-- Product Image -->
                            <img
                                src="{{ $item['product']->image ? asset($item['product']->image) : 'https://via.placeholder.com/80x80/3B82F6/FFFFFF?text=' . urlencode(substr($item['product']->name, 0, 1)) }}"
                                alt="{{ $item['product']->name }}"
                                class="w-20 h-20 object-cover rounded-lg"
                            >

                            <!-- Product Details -->
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800 text-sm">{{ $item['product']->name }}</h3>
                                <p class="text-blue-600 font-bold text-sm mt-1">
                                    Rp {{ number_format($item['product']->price, 0, ',', '.') }}
                                </p>

                                <!-- Quantity Controls -->
                                <div class="flex items-center space-x-2 mt-2">
                                    <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantities[{{ $item['product']->id }}]" value="{{ max(1, $item['quantity'] - 1) }}">
                                        <button type="submit" class="w-7 h-7 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300 transition" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                            </svg>
                                        </button>
                                    </form>

                                    <span class="w-12 text-center border border-gray-300 rounded-lg text-sm py-1 font-semibold">
                                        {{ $item['quantity'] }}
                                    </span>

                                    <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantities[{{ $item['product']->id }}]" value="{{ min($item['product']->stock, $item['quantity'] + 1) }}">
                                        <button type="submit" class="w-7 h-7 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition" {{ $item['quantity'] >= $item['product']->stock ? 'disabled' : '' }}>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Button -->
                            <div class="flex flex-col items-end justify-between h-20">
                                <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>

                                <span class="text-sm font-bold text-gray-800">
                                    Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-4 mt-4 text-white">
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
                        <span class="text-lg font-bold">Total</span>
                        <span class="text-2xl font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Checkout Button -->
            <div class="mt-4">
                <a
                    href="{{ route('orders.create') }}"
                    class="block w-full py-4 bg-gradient-to-r from-green-500 to-teal-600 text-white text-center font-bold rounded-xl hover:from-green-600 hover:to-teal-700 transition-all shadow-lg"
                >
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Checkout Sekarang
                </a>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="flex flex-col items-center justify-center py-16">
                <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Keranjang Kosong</h3>
                <p class="text-gray-500 text-center mb-6">
                    Yuk, mulai pesan makanan favoritmu!
                </p>
                <a
                    href="{{ route('products.index') }}"
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all"
                >
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>

</x-app-layout>
