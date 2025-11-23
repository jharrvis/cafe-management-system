<x-app-layout>
    <!-- Profile Content - Mobile App Style -->
    <div class="p-4 space-y-4">

        <!-- Profile Header Card -->
        <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="w-20 h-20 bg-white bg-opacity-20 backdrop-blur-md rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold">Profile</h2>
                    <p class="text-white text-opacity-90 text-sm">Kelola informasi akun Anda</p>
                </div>
            </div>
        </div>

        <!-- Update Profile Information -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-2xl p-5 shadow-md">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</x-app-layout>
