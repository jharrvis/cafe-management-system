<x-guest-layout>
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100">
        <!-- Background decoration -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-48 left-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-gray-900 mb-6">
                    <span class="block">Selamat Datang di</span>
                    <span class="block bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 mt-2">
                        Kantin Sekolah
                    </span>
                </h1>
                
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10">
                    Nikmati berbagai menu lezat dan bergizi di kantin sekolah kami. 
                    Pesan makanan dan minuman favoritmu dengan mudah dan cepat.
                </p>
                
                <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                    @auth
                        <a 
                            href="{{ route('dashboard') }}"
                            class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out transform hover:scale-105"
                        >
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a 
                            href="{{ route('login') }}"
                            class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out transform hover:scale-105"
                        >
                            Login
                        </a>
                        
                        <a 
                            href="{{ route('register') }}"
                            class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out transform hover:scale-105"
                        >
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Features section -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white bg-opacity-80 backdrop-blur-lg rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pesan Mudah</h3>
                    <p class="text-gray-600">Pilih menu favoritmu dan pesan dengan mudah melalui sistem online.</p>
                </div>
                
                <div class="bg-white bg-opacity-80 backdrop-blur-lg rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="text-green-600 text-4xl mb-4">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Menu Beragam</h3>
                    <p class="text-gray-600">Nikmati berbagai pilihan makanan, minuman, dan snack yang lezat dan bergizi.</p>
                </div>
                
                <div class="bg-white bg-opacity-80 backdrop-blur-lg rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="text-purple-600 text-4xl mb-4">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Antrean Teratur</h3>
                    <p class="text-gray-600">Dapatkan nomor antrian dan ambil pesananmu tanpa harus antre lama.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-guest-layout>