@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
                <a href="{{ route('roles.index') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <form action="{{ route('variables.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select name="type" id="type"
                        class="w-full px-4 border border-gray-300 rounded-md py-4 transition duration-150">
                        <option value="0">Select Type</option>
                        <option value="shortname">Short Name</option>
                        <option value="name">Name</option>
                        <option value="logo">Logo</option>
                        <option value="favicon">Favicon</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                        <option value="contact">Contact</option>
                        <option value="address">Address</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="value" class="block mb-2 text-sm font-medium text-gray-700">Value</label>
                    <input type="text" id="value" name="value"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                </div>
                <div class="flex justify-between mt-6">
                    <a href="{{ route('variables.index') }}"
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#type').change(function() {
                if ($(this).val().includes('logo') || $(this).val().includes('favicon')) {
                    $('#value').attr('type', 'file');
                } else {
                    $('#value').attr('type', 'text');
                }
            });
        });
    </script>
@endsection
