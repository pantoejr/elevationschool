@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-md shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Section Name</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200"
                            placeholder="Enter section name">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                            <select name="course_id" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="0">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="faculty_id" class="block text-sm font-medium text-gray-700">Faculty</label>
                            <select name="faculty_id" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="0">Select Faculty</option>
                                @foreach ($faculties as $faculty)
                                    <option value="{{ $faculty->id }}">{{ $faculty->full_name }}</option>
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
                            <input type="number" name="course_cost" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('course_cost')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <select  name="currency" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="USD">USD</option>
                                <option value="LRD">LRD</option>
                            </select>
                            @error('currency')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('end_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="max_students" class="block text-sm font-medium text-gray-700">Max No. Of Students</label>
                            <input type="number" name="max_students" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('max_students')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 p-4 border border-gray-300  rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex justify-between pt-6  border-gray-200">
                        <a href="{{ route('sections.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition">
                            <i class="fas fa-save mr-2"></i> Save Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
