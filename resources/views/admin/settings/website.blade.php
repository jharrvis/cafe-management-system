<x-app-layout>
    <div class="p-4 space-y-4 mb-20">
        <!-- Header -->
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.settings.index') }}" class="p-2 bg-white rounded-full shadow-md">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800">Pengaturan Website</h2>
                <p class="text-sm text-gray-500">Kelola informasi cafe dan aplikasi</p>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Settings Form -->
        <form action="{{ route('admin.settings.website.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Cafe Information -->
            <div class="bg-white rounded-2xl p-5 shadow-md">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informasi Cafe
                </h3>

                <div class="space-y-4">
                    <!-- Cafe Name -->
                    <div>
                        <label for="cafe_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Cafe *</label>
                        <input type="text" name="cafe_name" id="cafe_name"
                            value="{{ old('cafe_name', $settings['cafe_name'] ?? 'Kantin Sekolah') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        @error('cafe_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cafe Description -->
                    <div>
                        <label for="cafe_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="cafe_description" id="cafe_description" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('cafe_description', $settings['cafe_description'] ?? '') }}</textarea>
                        @error('cafe_description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cafe Address -->
                    <div>
                        <label for="cafe_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea name="cafe_address" id="cafe_address" rows="2"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('cafe_address', $settings['cafe_address'] ?? '') }}</textarea>
                        @error('cafe_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cafe Phone -->
                    <div>
                        <label for="cafe_phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="cafe_phone" id="cafe_phone"
                            value="{{ old('cafe_phone', $settings['cafe_phone'] ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="08xx-xxxx-xxxx">
                        @error('cafe_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Operating Hours -->
                    <div>
                        <label for="operating_hours" class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                        <input type="text" name="operating_hours" id="operating_hours"
                            value="{{ old('operating_hours', $settings['operating_hours'] ?? '07:00 - 15:00') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="07:00 - 15:00">
                        @error('operating_hours')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Settings -->
            <div class="bg-white rounded-2xl p-5 shadow-md">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Pengaturan Pesanan
                </h3>

                <div class="space-y-4">
                    <!-- Max Order Per Day -->
                    <div>
                        <label for="max_order_per_day" class="block text-sm font-medium text-gray-700 mb-2">Maksimal Pesanan Per Hari (per pelanggan)</label>
                        <input type="number" name="max_order_per_day" id="max_order_per_day" min="1"
                            value="{{ old('max_order_per_day', $settings['max_order_per_day'] ?? 10) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('max_order_per_day')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order Enabled -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div>
                            <label for="order_enabled" class="font-medium text-gray-800">Aktifkan Pemesanan</label>
                            <p class="text-xs text-gray-500 mt-1">Izinkan pelanggan melakukan pemesanan</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="order_enabled" id="order_enabled" value="1"
                                {{ (old('order_enabled', $settings['order_enabled'] ?? 1) == 1) ? 'checked' : '' }}
                                class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="sticky bottom-20 left-0 right-0">
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Simpan Pengaturan</span>
                    </div>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
