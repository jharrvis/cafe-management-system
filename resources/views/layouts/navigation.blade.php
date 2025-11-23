<!-- Top App Bar - Mobile Style -->
<nav class="bg-gradient-to-r from-blue-500 to-purple-600 sticky top-0 z-50 shadow-lg">
    <div class="px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo & Title -->
            <div class="flex items-center space-x-3">
                <div class="bg-white bg-opacity-20 backdrop-blur-md rounded-full p-2">
                    <svg width="32" height="32" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="60" cy="70" rx="35" ry="38" fill="#E74C3C"/>
                        <ellipse cx="60" cy="70" rx="30" ry="33" fill="#C0392B"/>
                        <circle cx="50" cy="65" r="4" fill="#2C3E50"/>
                        <circle cx="70" cy="65" r="4" fill="#2C3E50"/>
                        <circle cx="51" cy="64" r="1.5" fill="white"/>
                        <circle cx="71" cy="64" r="1.5" fill="white"/>
                        <path d="M 50 75 Q 60 82 70 75" stroke="#2C3E50" stroke-width="2" fill="none" stroke-linecap="round"/>
                        <ellipse cx="68" cy="35" rx="8" ry="12" fill="#27AE60" transform="rotate(20 68 35)"/>
                        <ellipse cx="60" cy="30" rx="28" ry="8" fill="white"/>
                        <rect x="32" y="22" width="56" height="8" fill="white" rx="2"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg">{{ $cafeName }}</h1>
                    <p class="text-white text-opacity-80 text-xs">{{ Auth::user()->name }}</p>
                </div>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center space-x-2">
                <!-- Profile Button -->
                <a href="{{ route('profile.edit') }}" class="p-2 rounded-full bg-white bg-opacity-20 backdrop-blur-md hover:bg-opacity-30 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="p-2 rounded-full bg-white bg-opacity-20 backdrop-blur-md hover:bg-opacity-30 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Bottom Navigation - Mobile Style (Fixed at bottom) -->
<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 shadow-lg">
    @if(Auth::user()->role === 'admin')
        <!-- Admin Bottom Navigation -->
        <div class="grid grid-cols-4 gap-1 px-2 py-2">
            <!-- Home/Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-xs font-medium">Home</span>
            </a>

            <!-- Products -->
            <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h15v12c0 1.657-1.343 3-3 3H6c-1.657 0-3-1.343-3-3V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 8h1c1.105 0 2 .895 2 2v2c0 1.105-.895 2-2 2h-1"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 21h12"/>
                </svg>
                <span class="text-xs font-medium">Produk</span>
            </a>

            <!-- Orders -->
            <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span class="text-xs font-medium">Pesanan</span>
            </a>

            <!-- Settings -->
            <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-xs font-medium">Pengaturan</span>
            </a>
        </div>
    @else
        <!-- Student Bottom Navigation -->
        <div class="grid grid-cols-4 gap-1 px-2 py-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-xs font-medium">Home</span>
            </a>

            <!-- Menu/Produk -->
            <a href="{{ route('products.index') }}" class="flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('products.*') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h15v12c0 1.657-1.343 3-3 3H6c-1.657 0-3-1.343-3-3V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 8h1c1.105 0 2 .895 2 2v2c0 1.105-.895 2-2 2h-1"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 21h12"/>
                </svg>
                <span class="text-xs font-medium">Menu</span>
            </a>

            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="relative flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('cart.*') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <div class="relative">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </div>
                <span class="text-xs font-medium">Keranjang</span>
            </a>

            <!-- Orders -->
            <a href="{{ route('orders.index') }}" class="flex flex-col items-center justify-center py-2 px-3 rounded-lg {{ request()->routeIs('orders.*') ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span class="text-xs font-medium">Pesanan</span>
            </a>
        </div>
    @endif
</nav>
