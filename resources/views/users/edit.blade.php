@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Edit User</h2>
                <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Image Section at the Top -->
                <div class="mb-6">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                    <div class="flex items-center space-x-4">
                        @if ($user->photo)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo"
                                    class="h-24 w-24 rounded-full object-cover border-2 border-gray-200">
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" id="photo" name="photo"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                            @error('photo')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Upload a new profile photo (JPEG, PNG, JPG, GIF, max 2MB)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Fields Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150 @error('email') border-red-500 @enderror" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="roleId" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select name="roleId" id="roleId" class="w-full px-4 py-3 border border-gray-300 rounded-md"
                            required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roleId')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password (Leave blank to
                            keep current)</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between mt-8 pt-4 border-t border-gray-200">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-150">
                        <i class="fas fa-chevron-left mr-2"></i> Back
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                        <i class="fas fa-save mr-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
