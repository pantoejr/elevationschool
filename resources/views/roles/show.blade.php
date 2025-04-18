@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto mb-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
                <a href="{{ route('roles.index') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" id="name" name="name" disabled value="{{ $role->name }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('roles.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-150">
                    <i class="fas fa-chevron-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </div>
    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            @livewire('role.add-permission', ['roleId' => $role->id])
        </div>
        <div>
            @livewire('role.remove-permisison', ['roleId' => $role->id])
        </div>
    </div>
@endsection
