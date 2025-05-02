<div class="grid grid-cols-1 mx-auto">
    <div class="overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue to-blue-dark p-6 text-black">
            <h1 class="text-2xl font-bold">Student Details</h1>
        </div>

        <!-- Photo Upload Section -->
        <div class="flex flex-col items-center space-y-4">
            <div class="relative">
                <div id="profile-image-container"
                    class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                    <img id="profile-preview" src="{{ $model->photo ? asset('storage/' . $model->photo) : '' }}"
                        alt="Profile Preview" class="{{ $model->photo ? '' : 'hidden' }} w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="p-6 space-y-6">
            <h2 class="text-lg font-semibold text-blue-500 border-b border-gray-300 pb-2">Personal Information</h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label for="first_name" class="block text-md font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name" disabled value="{{ $model->first_name }}"
                        class="w-full p-4 bg-gray-100 rounded-md border-0  transition">
                </div>
                <div>
                    <label for="middle_name" class="block text-md font-medium text-gray-700 mb-1">Middle
                        Name</label>
                    <input type="text" id="middle_name" name="middle_name" disabled value="{{ $model->middle_name }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
                <div>
                    <label for="last_name" class="block text-md font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name" disabled value="{{ $model->last_name }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="date_of_birth" class="block text-md font-medium text-gray-700 mb-1">Date of
                        Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" disabled
                        value="{{ $model->date_of_birth }}" class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-md font-medium text-gray-700 mb-1">Gender</label>
                    <select id="gender" name="gender" disabled class="w-full p-4 bg-gray-100 rounded-md transition">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $model->gender) == 'Male' ? 'selected' : '' }}>
                            Male</option>
                        <option value="Female" {{ old('gender', $model->gender) == 'Female' ? 'selected' : '' }}>
                            Female</option>
                        <option value="Unknown" {{ old('gender', $model->gender) == 'Unknown' ? 'selected' : '' }}>
                            Unknown</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="marital_status" class="block text-md font-medium text-gray-700 mb-1">Marital
                        Status</label>
                    <select id="marital_status" name="marital_status" disabled
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                        <option value="Single"
                            {{ old('marital_status', $model->marital_status) == 'Single' ? 'selected' : '' }}>
                            Single</option>
                        <option value="Married"
                            {{ old('marital_status', $model->marital_status) == 'Married' ? 'selected' : '' }}>
                            Married</option>
                        <option value="Engaged"
                            {{ old('marital_status', $model->marital_status) == 'Engaged' ? 'selected' : '' }}>
                            Engaged</option>
                        <option value="Divorced"
                            {{ old('marital_status', $model->marital_status) == 'Divorced' ? 'selected' : '' }}>
                            Divorced</option>
                    </select>
                </div>


                <div>
                    <label for="email" class="block text-md font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" disabled value="{{ $model->email }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
                <div>
                    <label for="place_of_birth_town" class="block text-md font-medium text-gray-700 mb-1">Place of
                        Birth (Town)</label>
                    <input type="text" name="place_of_birth_town" disabled value="{{ $model->place_of_birth_town }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
                <div>
                    <label for="place_of_birth_city" class="block text-md font-medium text-gray-700 mb-1">Place of
                        Birth (City)</label>
                    <input type="text" name="place_of_birth_city" disabled value="{{ $model->place_of_birth_city }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="place_of_birth_country" class="block text-md font-medium text-gray-700 mb-1">Place
                        of Birth (Country)</label>
                    <input type="text" id="place_of_birth_country" name="place_of_birth_country" disabled
                        value="{{ $model->place_of_birth_country }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
                <div>
                    <label for="nationality" class="block text-md font-medium text-gray-700 mb-1">Nationality</label>
                    <input type="text" id="nationality" name="nationality" disabled
                        value="{{ $model->nationality }}" class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
                <div>
                    <label for="official_language" class="block text-md font-medium text-gray-700 mb-1">Official
                        Language</label>
                    <input type="text" id="official_language" name="official_language" disabled
                        value="{{ $model->official_language }}" class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="permanent_address_town" class="block text-md font-medium text-gray-700 mb-1">Permanent
                        Address (Town)</label>
                    <input type="text" id="permanent_address_town" name="permanent_address_town" disabled
                        value="{{ $model->permanent_address_town }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
                <div>
                    <label for="permanent_address_city" class="block text-md font-medium text-gray-700 mb-1">Permanent
                        Address (City)</label>
                    <input type="text" id="permanent_address_city" name="permanent_address_city" disabled
                        value="{{ $model->permanent_address_city }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
                <div>
                    <label for="permanent_address_country"
                        class="block text-md font-medium text-gray-700 mb-1">Permanent Address (Country)</label>
                    <input type="text" id="permanent_address_country" name="permanent_address_country" disabled
                        value="{{ $model->permanent_address_country }}"
                        class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="mobile_phone" class="block text-md font-medium text-gray-700 mb-1">Mobile
                        Phone</label>
                    <input type="text" id="mobile_phone" name="mobile_phone" disabled
                        value="{{ $model->mobile_phone }}" class="w-full p-4 bg-gray-100 rounded-md transition">
                </div>
            </div>
            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-blue-500 border-b border-gray-300 pb-2">Parents Information
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="father_name" class="block text-md font-medium text-gray-700 mb-1">Father
                            Name</label>
                        <input type="text" id="father_name" name="father_name" disabled
                            value="{{ $model->father_name }}" class="w-full p-4 bg-gray-100 rounded-md transition">
                    </div>
                    <div>
                        <label for="mother_name" class="block text-md font-medium text-gray-700 mb-1">Mother
                            Name</label>
                        <input type="text" id="mother_name" name="mother_name" disabled
                            value="{{ $model->mother_name }}" class="w-full p-4 bg-gray-100 rounded-md transition">
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
                        <input type="text" id="emergency_contact_name" name="emergency_contact_name" disabled
                            value="{{ $model->emergency_contact_name }}"
                            class="w-full p-4 bg-gray-100 rounded-md transition">
                    </div>
                    <div>
                        <label for="emergency_contact_number"
                            class="block text-md font-medium text-gray-700 mb-1">Emergency Contact Number</label>
                        <input type="text" id="emergency_contact_number" name="emergency_contact_number" disabled
                            value="{{ $model->emergency_contact_number }}"
                            class="w-full p-4 bg-gray-100 rounded-md transition">
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-blue-500 border-b border-gray-300 pb-2">Educational
                    Background</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="computer_literacy" class="block text-md font-medium text-gray-700 mb-1">Computer
                            Literacy Level</label>
                        <select type="text" id="computer_literacy" name="computer_literacy" disabled
                            class="w-full p-4 bg-gray-100 rounded-md transition">
                            <option value="Beginner"
                                {{ old('computer_literacy', $model->computer_literacy) == 'Beginner' ? 'selected' : '' }}>
                                Beginner</option>
                            <option value="Intermediate"
                                {{ old('computer_literacy', $model->computer_literacy) == 'Intermediate' ? 'selected' : '' }}>
                                Intermediate</option>
                            <option value="Advanced"
                                {{ old('computer_literacy', $model->computer_literacy) == 'Advanced' ? 'selected' : '' }}>
                                Advanced</option>
                            <option value="Professional"
                                {{ old('computer_literacy', $model->computer_literacy) == 'Professional' ? 'selected' : '' }}>
                                Professional</option>
                        </select>
                    </div>
                    <div>
                        <label for="education_status" class="block text-md font-medium text-gray-700 mb-1">Education
                            Status</label>
                        <input type="text" id="education_status" name="education_status" disabled
                            value="{{ $model->education_status }}"
                            class="w-full p-4 bg-gray-100 rounded-md transition">
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-4">
                            <label for="status" class="block text-md font-medium text-gray-700">Status</label>
                            <select name="status" id="status" disabled
                                class="w-full p-4 bg-gray-100 rounded-md transition">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2">
                        <label for="is_new" class="flex items-center cursor-pointer">
                            <!-- toggle -->
                            <div class="relative">
                                <input type="checkbox" id="is_new" name="is_new" disabled class="sr-only"
                                    @if (old('is_new', $model->is_new ?? true)) checked @endif>
                                <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition">
                                </div>
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
                            }
                        </style>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('students.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
