<x-guest-layout>
    <!-- Fullscreen Mobile App Layout -->
    <div class="min-h-screen w-full bg-gradient-to-br from-blue-500 to-purple-600 flex flex-col">

        <!-- Header Section -->
        <div class="flex-shrink-0 pt-16 pb-12 px-6 text-center">
            <!-- Logo Apel dengan Topi Chef -->
            <div class="mx-auto mb-6 flex justify-center">
                <div class="bg-white bg-opacity-20 backdrop-blur-md rounded-full p-5">
                    <svg width="100" height="100" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Apel Body -->
                        <ellipse cx="60" cy="70" rx="35" ry="38" fill="#E74C3C"/>
                        <ellipse cx="60" cy="70" rx="30" ry="33" fill="#C0392B"/>
                        <ellipse cx="45" cy="65" rx="8" ry="12" fill="#E74C3C" opacity="0.3"/>

                        <!-- Mata -->
                        <circle cx="50" cy="65" r="4" fill="#2C3E50"/>
                        <circle cx="70" cy="65" r="4" fill="#2C3E50"/>
                        <circle cx="51" cy="64" r="1.5" fill="white"/>
                        <circle cx="71" cy="64" r="1.5" fill="white"/>

                        <!-- Mulut -->
                        <path d="M 50 75 Q 60 82 70 75" stroke="#2C3E50" stroke-width="2" fill="none" stroke-linecap="round"/>

                        <!-- Pipi -->
                        <circle cx="40" cy="72" r="5" fill="#FF6B6B" opacity="0.5"/>
                        <circle cx="80" cy="72" r="5" fill="#FF6B6B" opacity="0.5"/>

                        <!-- Daun -->
                        <ellipse cx="68" cy="35" rx="8" ry="12" fill="#27AE60" transform="rotate(20 68 35)"/>
                        <path d="M 68 35 Q 64 40 62 45" stroke="#229954" stroke-width="1.5" fill="none"/>

                        <!-- Tangkai -->
                        <path d="M 60 35 Q 62 30 65 32" stroke="#8B4513" stroke-width="3" fill="none" stroke-linecap="round"/>

                        <!-- Topi Chef -->
                        <ellipse cx="60" cy="30" rx="28" ry="8" fill="white"/>
                        <rect x="32" y="22" width="56" height="8" fill="white" rx="2"/>
                        <path d="M 35 22 Q 35 10 45 12 Q 48 8 52 10 Q 55 6 60 8 Q 65 6 68 10 Q 72 8 75 12 Q 85 10 85 22" fill="white"/>
                        <ellipse cx="60" cy="22" rx="25" ry="12" fill="#F8F9FA"/>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">
                {{ $cafeName }}
            </h1>
            <p class="text-white text-opacity-90 text-base">
                Masuk untuk melanjutkan
            </p>
        </div>

        <!-- Form Section - White Bottom Sheet -->
        <div class="flex-1 bg-white rounded-t-[2.5rem] px-6 pt-10 pb-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Username / Email -->
                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700 mb-2">Username / Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input
                            id="login"
                            name="login"
                            type="text"
                            value="{{ old('login') }}"
                            required
                            autocomplete="username"
                            class="appearance-none block w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base transition duration-200 bg-white"
                            placeholder="Masukkan Username atau Email"
                        >
                    </div>
                    <x-input-error :messages="$errors->get('login')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Kata Sandi -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="appearance-none block w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base transition duration-200 bg-white"
                            placeholder="Masukkan Kata Sandi"
                        >
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Tombol Login -->
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full flex justify-center items-center py-4 px-6 text-lg font-semibold rounded-xl text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-0 transition duration-200 transform active:scale-95"
                    >
                        <span>LOGIN</span>
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-8">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700">
                        Daftar Akun Baru
                    </a>
                </p>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-8 text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $cafeName }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
