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
                <h2 class="text-xl font-bold text-gray-800">Kelola Pelanggan</h2>
                <p class="text-sm text-gray-500">Manajemen data siswa</p>
            </div>
        </div>

        <!-- Success/Error Message -->
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

        @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <!-- Stats Card -->
        <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl p-5 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-opacity-90 text-sm mb-1">Total Siswa Terdaftar</p>
                    <h3 class="text-3xl font-bold">{{ $students->total() }}</h3>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Students List -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4">Daftar Siswa</h3>

            @if($students->count() > 0)
                <div class="space-y-3">
                    @foreach($students as $student)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="flex items-center space-x-3 flex-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-lg">{{ substr($student->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 truncate">{{ $student->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $student->email }}</p>
                                @if($student->nisn)
                                <p class="text-xs text-gray-400 mt-0.5">NISN: {{ $student->nisn }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 ml-2">
                            <!-- Order Count Badge -->
                            <div class="text-right mr-2">
                                <p class="text-xs text-gray-500">Pesanan</p>
                                <p class="text-sm font-bold text-blue-600">{{ $student->orders->count() }}</p>
                            </div>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.settings.customers.delete', $student->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan {{ $student->name }}? Semua pesanan akan ikut terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $students->links() }}
                </div>
            @else
                <div class="text-center py-12 text-gray-400">
                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-sm">Belum ada siswa terdaftar</p>
                </div>
            @endif
        </div>

        <!-- Info Card -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-medium text-blue-800">Informasi</p>
                    <p class="text-xs text-blue-700 mt-1">Menghapus pelanggan akan menghapus semua pesanan yang pernah dibuat oleh pelanggan tersebut.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
