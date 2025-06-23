<div class="grid grid-cols-1 mx-auto">
    <div class="overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Section Details</h2>
        </div>

        <!-- Section Details Form -->
        <div class="p-6">
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Section Name</label>
                    <input type="text" name="name" id="name" value="{{ $model->name }}" disabled
                        class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div class="mb-4">
                        <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                        <select name="course_id" id="course_id" disabled
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                            <option value="{{ $model->course->id }}">{{ $model->course->name }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="faculty_id" class="block text-sm font-medium text-gray-700">Faculty</label>
                        <select name="faculty_id" id="faculty_id" disabled
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                            <option value="{{ $model->faculty->id }}">{{ $model->faculty->full_name }}</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div class="mb-4">
                        <label for="course_cost" class="block text-sm font-medium text-gray-700">Cost</label>
                        <input type="number" name="course_cost" disabled value="{{ $model->course_cost }}"
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                        <select name="currency" disabled
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                            <option value="USD" {{ old('currency', $model->currency) == 'USD' ? 'selected' : '' }}>
                                USD</option>
                            <option value="LRD" {{ old('currency', $model->currency) == 'LRD' ? 'selected' : '' }}>
                                LRD</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $model->start_date }}"
                            disabled class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $model->end_date }}" disabled
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div class="mb-4">
                        <label for="max_students" class="block text-sm font-medium text-gray-700">Max Students</label>
                        <input type="number" name="max_students" id="max_students" value="{{ $model->max_students }}"
                            disabled class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" disabled
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                            <option value="active" {{ $model->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $model->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-2">
                    @if ($model->schedule)
                        <label class="block text-md font-medium text-gray-700 mb-1">Section Schedule</label>
                        @foreach ($model->schedule as $item)
                            <div class="flex items-center bg-gray-100 border-0 rounded-md p-4 mb-2">
                                <span class="font-semibold text-blue-700 w-28">{{ $item['day'] }}</span>
                                <span class="mx-2 ml-3 text-gray-600">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ date('g:i A', strtotime($item['start_time'])) }} -
                                    {{ date('g:i A', strtotime($item['end_time'])) }}
                                </span>
                                <span class="ml-3 text-md text-gray-600 italic">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $item['location'] }}
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="flex justify-between pt-6">
                    <a href="{{ route('sections.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
