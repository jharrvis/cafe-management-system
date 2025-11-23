<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Manajemen Produk</h1>
                <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition text-center text-sm sm:text-base">
                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                </a>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
                <div class="bg-white rounded-lg shadow p-3">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-box text-base"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs text-gray-500">Total</p>
                            <p class="text-lg font-bold text-gray-900">{{ $products->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-3">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-check-circle text-base"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs text-gray-500">Tersedia</p>
                            <p class="text-lg font-bold text-gray-900">{{ $products->where('is_available', true)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-3">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-red-100 text-red-600">
                            <i class="fas fa-exclamation-circle text-base"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs text-gray-500">Stok <</p>
                            <p class="text-lg font-bold text-gray-900">{{ $products->where('stock', '<=', 10)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-3">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-tags text-base"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs text-gray-500">Kategori</p>
                            <p class="text-lg font-bold text-gray-900">{{ $categories->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products List - Mobile Friendly -->
            <div class="space-y-3">
                @forelse($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="flex p-3">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-lg">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $product->description }}</p>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex items-center space-x-2 ml-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                           class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full font-medium">
                                        {{ $product->category->name }}
                                    </span>
                                    <span class="px-2 py-1 rounded-full font-semibold
                                        {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        Stok: {{ $product->stock }}
                                    </span>
                                    <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 rounded-full font-semibold
                                            {{ $product->is_available ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                            {{ $product->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </button>
                                    </form>
                                </div>

                                <!-- Price -->
                                <div class="mt-2">
                                    <span class="text-sm font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-md p-8 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-box text-2xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-500">Belum ada produk.</p>
                        <a href="{{ route('admin.products.create') }}" class="text-blue-600 hover:underline text-sm">Tambah produk pertama</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
