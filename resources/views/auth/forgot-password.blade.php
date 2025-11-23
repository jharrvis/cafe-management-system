<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl">
            <div class="text-center">
                <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-yellow-100">
                    <i class="fas fa-key text-3xl text-yellow-600"></i>
                </div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Lupa Kata Sandi?
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Masukkan email Anda dan kami akan kirimkan link untuk mengatur ulang kata sandi
                </p>
            </div>

            <div class="mt-4 text-sm text-gray-600">
                {{ __('Lupa kata sandi? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan kirimkan link pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Alamat email"
                        >
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                </div>

                <div class="flex flex-col space-y-4">
                    <button 
                        type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-300 ease-in-out transform hover:scale-[1.02]"
                    >
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-paper-plane text-yellow-300 group-hover:text-yellow-200"></i>
                        </span>
                        Kirim Link Atur Ulang
                    </button>
                    
                    <a href="{{ route('login') }}" class="text-center text-sm text-blue-600 hover:text-blue-500">
                        Kembali ke halaman masuk
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
