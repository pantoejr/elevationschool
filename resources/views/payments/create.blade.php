@extends('layouts.admin')
@section('content')
<div class="grid grid-cols-1  mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            <a href="{{ route('payments.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf


            <div class="mb-4">
                <label for="section_id" class="block text-sm font-medium text-gray-700">section</label>
                <select name="section_id" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200" hx-get="/payments/get_student" hx-target="#result">
                    <option value="0">Select section</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
                @error('section_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="student_id" class="block text-sm font-medium text-gray-700">Student</label>
                <select name="student_id" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="0">Select Student</option>
                    <div id="result"></div>
                </select>
                @error('section_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                <select name="currency" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="0">Select Currency</option>
                    <option value="USD">USD</option>
                    <option value="LRD">LRD</option>
                </select>
                @error('currency')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                <input type="text" id="amount" name="amount" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150 @error('amount')
                    @enderror"
                    placeholder="sum paid" />
                @error('amount')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            

            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                <select name="payment_method" required class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">Select Payment Method</option>
                    <option value="cash">Cash</option>
                    <option value="cheque">cheque</option>
                    <option value="deposit">deposit</option>
                    <option value="deferred">deferred</option>
                    <option value="mobile_money">Mobile Money</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="orange_money">Orange Money</option>
                </select>
                @error('payment_method')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div> 

            <div class="mb-4">
                <label for="reference" class="block text-sm font-medium text-gray-700 mb-2">Payment Reference</label>
                <input type="text" id="reference" name="reference" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150 @error('amount')
                    @enderror"
                    placeholder="Payment Reference" />
                @error('reference')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Attachments Section -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-blue-500 border-b pb-2">Attachment</h2>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    <label for="attachment" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-3xl text-primary mb-2"></i>
                        <p class="text-md text-gray-600">Drag & drop file here or click to browse</p>
                        <input type="file" id="attachment" name="attachment" multiple class="hidden">
                    </label>
                    <div id="file-list" class="mt-3 text-md text-gray-500 hidden">
                        <p>Selected file:</p>
                        <ul id="file-names" class="list-disc list-inside"></ul>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('payments.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-150">
                    <i class="fas fa-chevron-left mr-2"></i> Back
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                    <i class="fas fa-save mr-2"></i>Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection