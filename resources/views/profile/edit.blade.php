@extends('layouts.app')

@section('title', 'Edit Profile - Finapp')

@section('header', 'Edit Profile')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Profile Information</h2>
        
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ auth()->user()->name }}" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ auth()->user()->email }}" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                       required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 