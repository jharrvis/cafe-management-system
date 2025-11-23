<x-app-layout>
    <!-- Mobile App Style - Menu Kantin -->
    <div class="p-4 space-y-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Menu Kantin</h1>
            <a href="{{ route('cart.index') }}" class="relative p-2 bg-blue-500 rounded-full text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>
        </div>

        <!-- Categories Filter - Horizontal Scroll -->
        <div class="overflow-x-auto scrollbar-hide">
            <div class="flex gap-2 pb-2">
                <button
                    class="filter-btn active px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full text-sm font-medium whitespace-nowrap"
                    data-category="all"
                >
                    Semua
                </button>
                @foreach($categories as $category)
                    <button
                        class="filter-btn px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-full text-sm font-medium whitespace-nowrap hover:bg-gray-50"
                        data-category="{{ $category->id }}"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Products Grid - Mobile Style -->
        <div id="products-container" class="grid grid-cols-2 gap-3">
            @foreach($products as $product)
                <div class="product-card" data-category="{{ $product->category_id }}">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <div class="relative">
                            <img
                                src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/200x150/3B82F6/FFFFFF?text=' . urlencode($product->name) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-32 object-cover"
                            >
                            @if(!$product->is_available || $product->stock <= 0)
                                <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">HABIS</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-3">
                            <h3 class="font-semibold text-sm text-gray-800 mb-1 line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500 mb-2 line-clamp-1">{{ $product->description }}</p>

                            <div class="flex items-center justify-between mb-2">
                                <span class="text-blue-600 font-bold text-sm">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    Stok: {{ $product->stock }}
                                </span>
                            </div>

                            @if($product->is_available && $product->stock > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button
                                        type="submit"
                                        class="w-full py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-xs font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all"
                                    >
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Tambah
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full py-2 bg-gray-300 text-gray-500 text-xs font-medium rounded-lg cursor-not-allowed">
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const productCards = document.querySelectorAll('.product-card');

            // Category filter
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active button
                    filterBtns.forEach(b => {
                        b.classList.remove('active', 'bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white');
                        b.classList.add('bg-white', 'border', 'border-gray-200', 'text-gray-700');
                    });

                    this.classList.remove('bg-white', 'border', 'border-gray-200', 'text-gray-700');
                    this.classList.add('active', 'bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white');

                    const category = this.getAttribute('data-category');

                    productCards.forEach(card => {
                        if (category === 'all' || card.getAttribute('data-category') === category) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Add to cart with notification
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    this.submit();
                    showNotification('Produk ditambahkan ke keranjang!', 'success');
                });
            });

            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `fixed top-20 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${
                    type === 'success' ? 'bg-green-500' : 'bg-red-500'
                }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 2000);
            }
        });
    </script>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>