@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
                <a href="{{ route('variables.index') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <form action="{{ route('variables.update', ['systemVariable' => $variable ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="value" class="block mb-2 text-sm font-medium text-gray-700">Value</label>
                    @if ($variable->type == 'logo' || $variable->type == 'favicon')
                        <div class="mb-4">
                            <img id="preview" src="{{ asset('storage/' . $variable->value) }}" alt="Preview"
                                class="w-32 h-32 object-cover rounded-md mb-4">
                        </div>
                        <input type="file" id="value" name="value"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                    @else
                        <input type="text" id="value" name="value" value="{{ $variable->value }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                    @endif
                    @error('value')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select name="type" id="type"
                        class="w-full px-4 border border-gray-300 rounded-md py-4 transition duration-150" disabled>
                        <option value="shortname" {{ $variable->type == 'shortname' ? 'selected' : '' }}>Short Name</option>
                        <option value="name" {{ $variable->type == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="logo" {{ $variable->type == 'logo' ? 'selected' : '' }}>Logo</option>
                        <option value="favicon" {{ $variable->type == 'favicon' ? 'selected' : '' }}>Favicon</option>
                        <option value="email" {{ $variable->type == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="phone" {{ $variable->type == 'phone' ? 'selected' : '' }}>Phone</option>
                        <option value="contact" {{ $variable->type == 'contact' ? 'selected' : '' }}>Contact</option>
                        <option value="address" {{ $variable->type == 'address' ? 'selected' : '' }}>Address</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-between mt-6">
                    <a href="{{ route('variables.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-150">
                        <i class="fas fa-chevron-left mr-2"></i> Back
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                        <i class="fas fa-save mr-2"></i>Update
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

            // Preview uploaded image
            $('#value').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#preview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection