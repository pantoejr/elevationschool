{{-- filepath: /Users/joelpantoejr/Desktop/LaravelProjects/elevationschool/resources/views/sections/show.blade.php --}}
@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-md shadow-md overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Section Details</h2>
            </div>

            <!-- Section Details Form -->
            <div class="p-6">
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Section Name</label>
                        <input type="text" name="name" id="name" value="{{ $section->name }}" disabled
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                            <select name="course_id" id="course_id" disabled
                                class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                                <option value="{{ $section->course->id }}">{{ $section->course->name }}</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="faculty_id" class="block text-sm font-medium text-gray-700">Faculty</label>
                            <select name="faculty_id" id="faculty_id" disabled
                                class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                                <option value="{{ $section->faculty->id }}">{{ $section->faculty->full_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $section->start_date }}" disabled
                                class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $section->end_date }}" disabled
                                class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" disabled
                            class="mt-1 block w-full p-4  rounded-md bg-gray-100 focus:outline-none">
                            <option value="active" {{ $section->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $section->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-between pt-6">
                        <a href="{{ route('sections.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Sections
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection