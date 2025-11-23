<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Siswa</h1>
                    
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-400 bg-opacity-30">
                                    <i class="fas fa-shopping-cart text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm opacity-80">Pesanan Menunggu</p>
                                    <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-400 bg-opacity-30">
                                    <i class="fas fa-check-circle text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm opacity-80">Siap Diambil</p>
                                    <p class="text-2xl font-bold">{{ $readyOrders }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-400 bg-opacity-30">
                                    <i class="fas fa-history text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm opacity-80">Total Pesanan</p>
                                    <p class="text-2xl font-bold">{{ $userOrders->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Orders -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Pesanan Terbaru</h2>
                        
                        @if($userOrders->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Pesanan</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($userOrders as $order)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $order->order_number }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $order->created_at->format('d M Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
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
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <a href="{{ route('orders.show', $order->id) }}" 
                                                       class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye mr-1"></i>Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-shopping-bag text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">Anda belum memiliki pesanan</p>
                                <a href="{{ route('products.index') }}" 
                                   class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                            <div class="space-y-3">
                                <a href="{{ route('products.index') }}" 
                                   class="flex items-center px-4 py-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <i class="fas fa-utensils text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-medium text-gray-900">Lihat Menu</p>
                                        <p class="text-sm text-gray-500">Lihat semua menu yang tersedia</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('cart.index') }}" 
                                   class="flex items-center px-4 py-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="p-2 bg-green-100 rounded-lg">
                                        <i class="fas fa-shopping-cart text-green-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-medium text-gray-900">Lihat Keranjang</p>
                                        <p class="text-sm text-gray-500">Lihat produk di keranjang Anda</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('orders.index') }}" 
                                   class="flex items-center px-4 py-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="p-2 bg-purple-100 rounded-lg">
                                        <i class="fas fa-history text-purple-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="font-medium text-gray-900">Riwayat Pesanan</p>
                                        <p class="text-sm text-gray-500">Lihat semua pesanan Anda</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Info Akun</h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Nama</p>
                                    <p class="font-medium">{{ Auth::user()->name }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ Auth::user()->email }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">NISN</p>
                                    <p class="font-medium">{{ Auth::user()->nisn ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        bg-green-100 text-green-800">
                                        {{ Auth::user()->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </div>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" 
                               class="mt-4 w-full inline-block px-4 py-2 bg-blue-600 text-white text-center rounded-md hover:bg-blue-700">
                                <i class="fas fa-user-edit mr-2"></i>Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>