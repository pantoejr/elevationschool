@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-md shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('sections.update', $section->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Section Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $section->name) }}"
                            required
                            class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200"
                            placeholder="Enter section name">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                            <select name="course_id" required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="0">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ old('course_id', $section->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="faculty_id" class="block text-sm font-medium text-gray-700">Faculty</label>
                            <select name="faculty_id" required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="0">Select Faculty</option>
                                @foreach ($faculties as $faculty)
                                    <option value="{{ $faculty->id }}"
                                        {{ old('faculty_id', $section->faculty_id) == $faculty->id ? 'selected' : '' }}>
                                        {{ $faculty->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('faculty_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="course_cost" class="block text-sm font-medium text-gray-700">Cost</label>
                            <input type="number" name="course_cost" value="{{ $section->course_cost }}"
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('course_cost')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <select name="currency"
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="USD"
                                    {{ old('currency', $section->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="LRD"
                                    {{ old('currency', $section->currency) == 'LRD' ? 'selected' : '' }}>LRD</option>
                            </select>
                            @error('currency')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date', $section->start_date) }}"
                                required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date', $section->end_date) }}"
                                required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('end_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="max_students" class="block text-sm font-medium text-gray-700">Max No. of
                                Students</label>
                            <input type="number" name="max_students" value="{{ $section->max_students }}"
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('max_students')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 p-4 border rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="active" {{ old('status', $section->status) == 'active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="inactive"
                                    {{ old('status', $section->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Section Schedule</label>
                            <div id="schedule-list">
                                @if (old('schedule', $section->schedule))
                                    @foreach (old('schedule', $section->schedule) as $i => $item)
                                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 mb-2 schedule-row">
                                            <select name="schedule[{{ $i }}][day]"
                                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200"
                                                required>
                                                <option value="">Select Day</option>
                                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                    <option value="{{ $day }}"
                                                        {{ $item['day'] == $day ? 'selected' : '' }}>{{ $day }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="time" name="schedule[{{ $i }}][start_time]"
                                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200"
                                                required value="{{ $item['start_time'] }}">
                                            <input type="time" name="schedule[{{ $i }}][end_time]"
                                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200"
                                                required value="{{ $item['end_time'] }}">
                                            <input type="text" name="schedule[{{ $i }}][location]"
                                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200"
                                                required value="{{ $item['location'] }}" placeholder="Location">
                                            <button type="button"
                                                class="remove-schedule-row bg-red-500 text-white px-3 py-1 mb-3 rounded">Remove</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add-schedule-row"
                                class="mt-2 px-3 py-1 bg-green-500 text-white rounded">Add Day</button>
                        </div>
                    </div>
                    <div class="flex justify-between pt-6 border-gray-200">
                        <a href="{{ route('sections.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition">
                            <i class="fas fa-save mr-2"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let scheduleIndex = {{ isset($section->schedule) ? count($section->schedule) : 1 }};
        $('#add-schedule-row').on('click', function() {
            let row = `
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 mb-2 schedule-row">
                    <select name="schedule[${scheduleIndex}][day]" class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <option value="">Select Day</option>
                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                        <option>Saturday</option>
                        <option>Sunday</option>
                    </select>
                    <input type="time" name="schedule[${scheduleIndex}][start_time]" class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    <input type="time" name="schedule[${scheduleIndex}][end_time]" class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    <input type="text" name="schedule[${scheduleIndex}][location]" class="mt-1 block w-full p-4 border border-gray-300 rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200" required placeholder="Location">
                    <button type="button" class="remove-schedule-row  bg-red-500 text-white px-3 py-1 mb-3 rounded">Remove</button>
                </div>
                `;
            $('#schedule-list').append(row);
            scheduleIndex++;
        });
        $(document).on('click', '.remove-schedule-row', function() {
            $(this).closest('.schedule-row').remove();
        });
    </script>
@endsection
