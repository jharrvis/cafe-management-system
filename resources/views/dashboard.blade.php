<x-app-layout>
    <!-- Student Dashboard - Mobile App Style -->
    <div class="p-4 space-y-4">

        <!-- Welcome Card -->
        <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
            <p class="text-white text-opacity-90">{{ Auth::user()->name }}</p>
            <p class="text-sm text-white text-opacity-80 mt-1">{{ Auth::user()->email }}</p>
            @if(Auth::user()->nisn)
                <p class="text-xs text-white text-opacity-70 mt-1">NISN: {{ Auth::user()->nisn }}</p>
            @endif
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

        <!-- Promo Slider -->
        <div class="relative w-full rounded-2xl shadow-lg">
            <!-- Slider Wrapper -->
            <div class="overflow-hidden rounded-2xl relative">
                <div class="flex transition-transform duration-500 ease-in-out" id="promoSlider">
                    <!-- Slide 1 -->
                    <div class="w-full flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1625944525533-473f1f257e43?w=800&h=400&fit=crop&auto=format" alt="Milkshake Segar" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                            <h3 class="font-bold text-xl mb-1">Milkshake Segar! 🥤</h3>
                            <p class="text-sm">Berbagai varian rasa milkshake segar</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="w-full flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1621939514649-280e2ee25f60?w=800&h=400&fit=crop&auto=format" alt="Snack Enak" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                            <h3 class="font-bold text-xl mb-1">Snack Enak! 🍟</h3>
                            <p class="text-sm">Cemilan nikmat untuk teman belajar</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="w-full flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&h=400&fit=crop&auto=format" alt="Pizza" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                            <h3 class="font-bold text-xl mb-1">Pizza Favorit! 🍕</h3>
                            <p class="text-sm">Pizza hangat dengan topping pilihan</p>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="w-full flex-shrink-0 relative">
                        <img src="https://images.unsplash.com/photo-1490885578174-acda8905c2c6?w=800&h=400&fit=crop&auto=format" alt="Sehat" class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                            <h3 class="font-bold text-xl mb-1">Menu Sehat! 🥗</h3>
                            <p class="text-sm">Pilihan menu sehat dan bergizi</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button id="prevSlide" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-2 shadow-lg transition-all">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="nextSlide" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-2 shadow-lg transition-all">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Dots Indicator -->
                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
                    <button class="dot w-2 h-2 rounded-full bg-white transition-all" data-index="0"></button>
                    <button class="dot w-2 h-2 rounded-full bg-white/50 transition-all" data-index="1"></button>
                    <button class="dot w-2 h-2 rounded-full bg-white/50 transition-all" data-index="2"></button>
                    <button class="dot w-2 h-2 rounded-full bg-white/50 transition-all" data-index="3"></button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let currentSlide = 0;
                const slider = document.getElementById('promoSlider');
                const dots = document.querySelectorAll('.dot');
                const totalSlides = 4;

                function updateSlider() {
                    // Move slider
                    slider.style.transform = `translateX(-${currentSlide * 100}%)`;

                    // Update dots
                    dots.forEach((dot, index) => {
                        if (index === currentSlide) {
                            dot.classList.remove('bg-white/50');
                            dot.classList.add('bg-white');
                        } else {
                            dot.classList.remove('bg-white');
                            dot.classList.add('bg-white/50');
                        }
                    });
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    updateSlider();
                }

                function prevSlide() {
                    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                    updateSlider();
                }

                function goToSlide(index) {
                    currentSlide = index;
                    updateSlider();
                }

                // Event listeners
                document.getElementById('nextSlide').addEventListener('click', nextSlide);
                document.getElementById('prevSlide').addEventListener('click', prevSlide);

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => goToSlide(index));
                });

                // Auto slide every 5 seconds
                setInterval(nextSlide, 5000);

                // Initialize
                updateSlider();
            });
        </script>

        <!-- Info Card -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-bold text-blue-800">Cara Pesan Makanan</p>
                    <ol class="text-xs text-blue-700 mt-2 space-y-1 list-decimal list-inside">
                        <li>Klik "Pesan Makanan" untuk melihat menu</li>
                        <li>Pilih makanan yang kamu inginkan</li>
                        <li>Tambahkan ke keranjang</li>
                        <li>Checkout dan tunggu pesanan siap</li>
                        <li>Ambil pesanan di kantin dengan tunjukkan nomor pesanan</li>
                    </ol>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
