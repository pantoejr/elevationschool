@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-md shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200"
                            placeholder="Enter course name">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                        <select name="duration" id="duration"
                            class="mt-1 block w-full border-gray-300 p-4 border border-gray-300  rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Select Duration</option>
                            <option value="one_month">One Month</option>
                            <option value="two_months">Two Months</option>
                            <option value="three_months">Three Months</option>
                            <option value="four_months">Four Months</option>
                            <option value="five_months">Five Months</option>
                            <option value="six_months">Six Months</option>
                        </select>
                        @error('duration')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="cost" class="block text-sm font-medium text-gray-700">Cost</label>
                        <input type="number" name="cost" id="cost" required
                            class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200"
                            placeholder="Enter course cost">
                        @error('cost')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                        <select name="currency" id="currency"
                            class="mt-1 block w-full border-gray-300 p-4 border border-gray-300  rounded-md  focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Select currency</option>
                            <option value="USD">USD</option>
                            <option value="LRD">LRD</option>
                        </select>
                        @error('currency')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-between pt-6  border-gray-200">
                        <a href="{{ route('courses.index') }}"
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
