@extends('layouts.guest')

@section('title', 'Register - Finapp')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="glass-effect rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 p-8" data-aos="fade-up">
            <div class="flex flex-col items-center mb-6">
                <img class="h-12 w-auto mb-2" src="/images/logo.svg" alt="Finapp Logo">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Finapp
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Create your account</p>
                </div>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 text-center">
                    Or
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                        sign in to your existing account
                    </a>
                </p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-900 border border-red-400 text-red-700 dark:text-red-300 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full name</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Full name" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Email address" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                        <select id="role" name="role" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <option value="">Select your role</option>
                            <option value="UMKM Owner" {{ old('role') == 'UMKM Owner' ? 'selected' : '' }}>UMKM Owner</option>
                        </select>
                    </div>
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                        <input id="phone_number" name="phone_number" type="text" autocomplete="tel" required
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Phone Number" value="{{ old('phone_number') }}">
                    </div>
                    <div>
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Profile Picture</label>
                        <input id="profile_picture" name="profile_picture" type="file" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    </div>
                    <div id="business_name_field" style="display: {{ old('role') == 'UMKM Owner' ? 'block' : 'none' }};">
                        <label for="business_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Business Name</label>
                        <input id="business_name" name="business_name" type="text" autocomplete="organization" 
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Your Business Name" value="{{ old('business_name') }}">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Confirm password">
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit"
                            class="w-full flex justify-center items-center py-2 px-4 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        <i class="fas fa-user-plus mr-2"></i> Create account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const businessNameField = document.getElementById('business_name_field');
        const businessNameInput = document.getElementById('business_name');

        function toggleBusinessNameField() {
            if (roleSelect.value === 'UMKM Owner') {
                businessNameField.style.display = 'block';
                businessNameInput.setAttribute('required', 'required');
            } else {
                businessNameField.style.display = 'none';
                businessNameInput.removeAttribute('required');
                businessNameInput.value = ''; // Clear value when hidden
            }
        }

        // Initial check on page load
        toggleBusinessNameField();

        // Listen for changes in the role select
        roleSelect.addEventListener('change', toggleBusinessNameField);
    });
</script>
@endsection 