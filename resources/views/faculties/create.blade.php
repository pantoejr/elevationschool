@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue to-blue-dark p-6 text-black">
                <h1 class="text-2xl font-bold">{{ $title }}</h1>
            </div>

            <!-- Form -->
            <form action="{{ route('faculties.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <!-- Photo Upload Section -->
                <div class="flex flex-col items-center space-y-4">
                    <div class="relative">
                        <div id="profile-image-container"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                            <img id="profile-preview" src="" alt="Profile Preview"
                                class="hidden w-full h-full object-cover">
                        </div>
                        <label for="photo-upload"
                            class="absolute bottom-2 -right-2 bg-white rounded-full p-2 shadow-md cursor-pointer hover:bg-gray-50 transition">
                            <i class="fas fa-camera text-primary"></i>
                            <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <p class="text-sm text-gray-500">Click the camera icon to upload a photo</p>
                </div>

                <!-- Personal Information Section -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Personal Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                @error('full_name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth
                                *</label>
                            <input type="date" id="dob" name="dob" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                @error('dob')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                            <select id="gender" name="gender" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>


                        <div>
                            <label for="roleId" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                            <select id="roleId" name="roleId" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                <option value="active">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Email -->
                      

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                            <textarea id="address" name="address" rows="2" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Attachments Section -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Attachments</h2>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <label for="attachments" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-primary mb-2"></i>
                            <p class="text-sm text-gray-600">Drag & drop files here or click to browse</p>
                            <input type="file" id="attachments" name="attachments[]" multiple class="hidden">
                        </label>
                        <div id="file-list" class="mt-3 text-sm text-gray-500 hidden">
                            <p>Selected files:</p>
                            <ul id="file-names" class="list-disc list-inside"></ul>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('faculties.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition">
                        <i class="fas fa-save mr-2"></i> Save Faculty
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Profile Photo Preview
            $('#photo-upload').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#profile-preview').attr('src', event.target.result).removeClass('hidden');
                        $('#default-icon').addClass('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Attachments Preview
            $('#attachments').on('change', function(e) {
                const files = e.target.files;
                const $fileList = $('#file-list');
                const $fileNames = $('#file-names');

                if (files.length > 0) {
                    $fileNames.empty();
                    for (let i = 0; i < files.length; i++) {
                        $fileNames.append(`<li>${files[i].name}</li>`);
                    }
                    $fileList.removeClass('hidden');
                } else {
                    $fileList.addClass('hidden');
                }
            });

            // Drag and drop for attachments
            const $dropArea = $('.border-dashed');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                $dropArea.on(eventName, preventDefaults);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                $dropArea.on(eventName, highlight);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                $dropArea.on(eventName, unhighlight);
            });

            function highlight() {
                $dropArea.addClass('border-primary bg-blue-50');
            }

            function unhighlight() {
                $dropArea.removeClass('border-primary bg-blue-50');
            }

            $dropArea.on('drop', function(e) {
                const dt = e.originalEvent.dataTransfer;
                const files = dt.files;
                $('#attachments')[0].files = files;

                // Trigger the change event
                $('#attachments').trigger('change');
            });
        });
    </script>
@endsection
