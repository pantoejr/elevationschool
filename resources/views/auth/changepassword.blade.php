@extends('layouts.admin')
@section('content')
    <div class="flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="relative bg-blue-800 text-center flex items-center justify-center min-h-[75px]">
                    <div>
                        <p class="text-2xl font-medium text-white mt-1">Change Password</p>
                    </div>
                </div>

                <form class="p-6 space-y-6" method="POST" action="{{ route('confirm-change-password') }}">
                    @csrf
                    <div class="space-y-2">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="text" id="current_password" name="current_password"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg" />
                                @error('current_password')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="text" id="new_password" name="new_password"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg" />
                                @error('new_password')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
