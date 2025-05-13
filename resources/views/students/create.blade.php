@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue to-blue-dark p-6 text-black">
                <h1 class="text-2xl font-bold">{{ $title }}</h1>
            </div>
            <!-- Form -->
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
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
                    <p class="text-md text-gray-500">Click the camera icon to upload a photo</p>
                </div>

                <!-- Personal Information Section -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-blue-500 border-b border-gray-300 pb-2">Personal Information</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label for="first_name" class="block text-md font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" id="first_name" name="first_name" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                            @error('first_name')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="middle_name" class="block text-md font-medium text-gray-700 mb-1">Middle
                                Name</label>
                            <input type="text" id="middle_name" name="middle_name" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                            @error('middle_name')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-md font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                            @error('last_name')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="date_of_birth" class="block text-md font-medium text-gray-700 mb-1">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                            @error('dob')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-md font-medium text-gray-700 mb-1">Gender</label>
                            <select id="gender" name="gender" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Unknow">Other</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="marital_status" class="block text-md font-medium text-gray-700 mb-1">Marital
                                Status</label>
                            <select id="marital_status" name="marital_status" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Engaged">Engaged</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>


                        <div>
                            <label for="email" class="block text-md font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                        <div>
                            <label for="place_of_birth_town" class="block text-md font-medium text-gray-700 mb-1">Place of
                                Birth (Town)</label>
                            <input type="text" name="place_of_birth_town"
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label for="place_of_birth_city" class="block text-md font-medium text-gray-700 mb-1">Place of
                                Birth (City)</label>
                            <input type="text" name="place_of_birth_city"
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="place_of_birth_country" class="block text-md font-medium text-gray-700 mb-1">Place
                                of Birth (Country)</label>
                            <input type="text" id="place_of_birth_country" name="place_of_birth_country" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                        <div>
                            <label for="nationality"
                                class="block text-md font-medium text-gray-700 mb-1">Nationality</label>
                            <input type="text" id="nationality" name="nationality" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                        <div>
                            <label for="official_language" class="block text-md font-medium text-gray-700 mb-1">Official
                                Language</label>
                            <input type="text" id="official_language" name="official_language" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="permanent_address_town"
                                class="block text-md font-medium text-gray-700 mb-1">Permanent Address (Town)</label>
                            <input type="text" id="permanent_address_town" name="permanent_address_town" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                        <div>
                            <label for="permanent_address_city"
                                class="block text-md font-medium text-gray-700 mb-1">Permanent Address (City)</label>
                            <input type="text" id="permanent_address_city" name="permanent_address_city" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                        <div>
                            <label for="permanent_address_country"
                                class="block text-md font-medium text-gray-700 mb-1">Permanent Address (Country)</label>
                            <input type="text" id="permanent_address_country" name="permanent_address_country"
                                required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="mobile_phone" class="block text-md font-medium text-gray-700 mb-1">Mobile
                                Phone</label>
                            <input type="text" id="mobile_phone" name="mobile_phone" required
                                class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-blue-500 border-b border-gray-300 pb-2">Parents Information
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="father_name" class="block text-md font-medium text-gray-700 mb-1">Father
                                    Name</label>
                                <input type="text" id="father_name" name="father_name" required
                                    class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                            </div>
                            <div>
                                <label for="mother_name" class="block text-md font-medium text-gray-700 mb-1">Mother
                                    Name</label>
                                <input type="text" id="mother_name" name="mother_name" required
                                    class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-blue-500 border-b border-gray-300 pb-2">Emergency Contact
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="emergency_contact_name"
                                    class="block text-md font-medium text-gray-700 mb-1">Emergency Contact Name</label>
                                <input type="text" id="emergency_contact_name" name="emergency_contact_name" required
                                    class="w-full px-3 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                            </div>
                            <div>
                                <label for="emergency_contact_number"
                                    class="block text-md font-medium text-gray-700 mb-1">Emergency Contact Number</label>
                                <input type="text" id="emergency_contact_number" name="emergency_contact_number"
                                    required
                                    class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                @error('emergency_contact_number')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-blue-500 border-b border-gray-300 pb-2">Educational
                            Background</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="computer_literacy"
                                    class="block text-md font-medium text-gray-700 mb-1">Computer Literacy Level</label>
                                <select type="text" id="computer_literacy" name="computer_literacy" required
                                    class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                    <option value="Professional">Professional</option>
                                </select>
                                @error('education_status')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="education_status"
                                    class="block text-md font-medium text-gray-700 mb-1">Education Status</label>
                                <input type="text" id="education_status" name="education_status" required
                                    class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                @error('education_status')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="section_id" class="block text-md font-medium text-gray-700 mb-1">Course
                                    Applying For</label>
                                <select type="text" id="section_id" name="section_id" required
                                    class="w-full p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition">
                                    <option value="0">Select Course</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">
                                            {{ $section->name . ' ( ' . $section->course->name . ' ) ' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-md font-medium text-gray-700">Status</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full border-gray-300 p-4 border  rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2">
                            <label for="is_new" class="flex items-center cursor-pointer">
                                <!-- toggle -->
                                <div class="relative">
                                    <input type="checkbox" id="is_new" name="is_new" class="sr-only"
                                        @if (old('is_new', $model->is_new ?? true)) checked @endif>
                                    <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                                    <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                                </div>
                                <!-- label -->
                                <div class="ml-3 text-gray-700 font-medium">
                                    Is New
                                </div>
                            </label>
                            <style>
                                input:checked~.dot {
                                    transform: translateX(100%);
                                    background-color: #ffffff;
                                }

                                input:checked~.block {
                                    background-color: #2161f5;
                                    /* You can change this to your primary color */
                                }
                            </style>
                        </div>
                    </div>
                </div>
                <!-- Attachments Section -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-blue-500 border-b pb-2">Attachments</h2>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <label for="attachments" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-primary mb-2"></i>
                            <p class="text-md text-gray-600">Drag & drop files here or click to browse</p>
                            <input type="file" id="attachments" name="attachments[]" multiple class="hidden">
                        </label>
                        <div id="file-list" class="mt-3 text-md text-gray-500 hidden">
                            <p>Selected files:</p>
                            <ul id="file-names" class="list-disc list-inside"></ul>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('students.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition">
                        <i class="fas fa-save mr-2"></i> Save Student
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
