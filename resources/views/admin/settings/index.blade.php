<x-app-layout>
    <div class="p-4 space-y-4">
        <!-- Header -->
        <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2">Pengaturan</h2>
            <p class="text-white text-opacity-90 text-sm">Kelola pengaturan aplikasi dan data pelanggan</p>
        </div>

        <!-- Settings Menu -->
        <div class="grid grid-cols-1 gap-3">
            <!-- Website Settings -->
            <a href="{{ route('admin.settings.website') }}" class="bg-white rounded-2xl p-5 shadow-md hover:shadow-lg transition">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 text-lg">Pengaturan Website</h3>
                        <p class="text-gray-500 text-sm mt-1">Nama cafe, deskripsi, jam operasional, dll</p>
                    </div>
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <!-- Customer Management -->
            <a href="{{ route('admin.settings.customers') }}" class="bg-white rounded-2xl p-5 shadow-md hover:shadow-lg transition">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 text-lg">Kelola Pelanggan</h3>
                        <p class="text-gray-500 text-sm mt-1">Manajemen data siswa/pelanggan</p>
                    </div>
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <!-- Category Management -->
            <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-2xl p-5 shadow-md hover:shadow-lg transition">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 text-lg">Kelola Kategori</h3>
                        <p class="text-gray-500 text-sm mt-1">Manajemen kategori produk</p>
                    </div>
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        </div>

        <!-- Info Card -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-medium text-blue-800">Informasi</p>
                    <p class="text-xs text-blue-700 mt-1">Pengaturan yang diubah akan langsung diterapkan ke seluruh aplikasi.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
