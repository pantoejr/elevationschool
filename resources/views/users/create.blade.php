@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
                <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5">
                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                        <input type="file" id="photo" name="photo"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                        @error('photo')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                        @error('name')
                            <p class="mt-1
                            text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="roleId" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select name="roleId" id="roleId" class="w-full px-4 py-3 border border-gray-300 rounded-md"
                            required>
                            <option value="0">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roleId')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150 @error('email')
                             border-red-500
                           @enderror" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150 @error('email')
                              border-red-500
                            @enderror" />
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div class="flex justify-between mt-6">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-150">
                        <i class="fas fa-chevron-left mr-2"></i> Back
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                        <i class="fas fa-save mr-2"></i>Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
