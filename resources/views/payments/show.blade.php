@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>

                <div class="flex items-center gap-2">
                    <!-- Receipt Button -->
                    <button data-modal-target="receipt-modal" data-modal-toggle="receipt-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-receipt"></i>
                    </button>

                    <a href="{{ route('payments.downloadPdf', ['payment' => $payment]) }}" target="_blank"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>


            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center mb-4">
                <img src="{{ asset('storage/' . $payment->attachment) }}" alt="Attachment" width="250">
            </div>
            <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
                <div class="mb-4">
                    <label for="invoice_id" class="block text-sm font-medium text-gray-700 mb-2">Invoice ID</label>
                    <input type="text" id="invoice_id" name="invoice_id" disabled
                        value="{{ $payment->student_invoice_id }}"
                        class="w-full p-4 border-0 bg-gray-100 rounded-md transition duration-150 " />
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="text" id="amount" name="amount" disabled value="{{ $payment->amount_paid }}"
                        class="w-full p-4 border-0 bg-gray-100 rounded-md transition duration-150 " />
                </div>
                <div class="mb-4">
                    <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                    <input type="text" id="payment_date" name="payment_date" disabled
                        value="{{ $payment->payment_date }}"
                        class="w-full p-4 border-0 bg-gray-100 rounded-md transition duration-150 " />
                </div>
                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <input type="text" id="payment_method" name="payment_method" disabled
                        value="{{ strtoupper($payment->payment_method) }}"
                        class="w-full p-4 border-0 bg-gray-100 rounded-md transition duration-150 " />
                </div>
                <div class="mb-4">
                    <label for="payment_reference" class="block text-sm font-medium text-gray-700 mb-2">Payment
                        Reference</label>
                    <input type="text" id="payment_reference" name="payment_reference" disabled
                        value="{{ $payment->payment_reference }}"
                        class="w-full p-4 border-0 bg-gray-100 rounded-md transition duration-150 " />
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <input type="text" id="status" name="status" disabled value="{{ strtoupper($payment->status) }}"
                        class="w-full p-4 border-0 bg-gray-100 rounded-md transition duration-150 " />
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea id="notes" name="notes" disabled
                        class="w-full p-4 border-0 bg-gray-100 rounded-md transition duration-150 ">{{ strtoupper($payment->notes) }}</textarea>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <form action="">
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <button type="submit" name="action" value="approved"
                            class="bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg text-sm px-5 py-2.5">Approve</button>
                        <button type="submit" name="action" value="rejected"
                            class="bg-red-700 hover:bg-red-800 text-white font-medium rounded-lg text-sm px-5 py-2.5">Reject</button>
                        <a href="{{ route('payments.index') }}"
                            class="bg-gray-300 text-white text-center font-medium rounded-lg text-sm px-5 py-2.5">Back To
                            List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add Receipt Modal --}}
    <div id="receipt-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm p-3">
                <iframe src="{{ route('payments.previewPdf', ['payment' => $payment]) }}" width="100%"
                    height="600px"></iframe>
            </div>
        </div>
    </div>
    {{-- End of Receipt Modal --}}
@endsection
