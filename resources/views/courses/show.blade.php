@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-md shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" disabled
                        class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                    <select name="duration" id="duration" disabled
                        class="mt-1 block w-full border-gray-300 p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">Select Duration</option>
                        <option value="one_month" {{ old('duration', $course->duration) == 'one_month' ? 'selected' : '' }}>
                            One Month</option>
                        <option value="two_months"
                            {{ old('duration', $course->duration) == 'two_months' ? 'selected' : '' }}>Two Months</option>
                        <option value="three_months"
                            {{ old('duration', $course->duration) == 'three_months' ? 'selected' : '' }}>Three Months
                        </option>
                        <option value="four_months"
                            {{ old('duration', $course->duration) == 'four_months' ? 'selected' : '' }}>Four Months</option>
                        <option value="five_months"
                            {{ old('duration', $course->duration) == 'five_months' ? 'selected' : '' }}>Five Months</option>
                        <option value="six_months"
                            {{ old('duration', $course->duration) == 'six_months' ? 'selected' : '' }}>Six Months</option>
                    </select>

                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Course Description</label>
                    <input type="text" name="description" id="description" value="{{ old('description', $course->description) }}" disabled
                        class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                    
                </div>
                <div class="flex justify-between pt-6 border-gray-200">
                    <a href="{{ route('courses.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
