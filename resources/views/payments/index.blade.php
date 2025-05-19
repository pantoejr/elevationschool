@extends('layouts.admin')
@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            <a href="{{ route('payments.create') }}" class="px-2 py-1 rounded-sm bg-blue-600 text-white hover:bg-blue-700">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            @if ($payments->isEmpty())
                <p class="text-gray-700 text-center py-3">No record found...</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                                No.
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                                Reference
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($payments as $payment)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                    {{ $payment->studentInvoice->studentSection->student->first_name . ' ' . $payment->studentInvoice->studentSection->student->middle_name . ' ' . $payment->studentInvoice->studentSection->student->last_name  }}
                                </td>
                                 <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                    {{ $payment->payment_reference }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                    ${{ $payment->amount_paid }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-md font-medium">
                                    <a href="{{ route('payments.edit', ['payment' => $payment]) }}"
                                        class="text-yellow-600 hover:text-yellow-900 mr-4">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('payments.show', ['payment' => $payment]) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-4">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('payments.destroy', ['payment' => $payment]) }}"
                                        style="display: inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900 delete-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        
    </div>
@endsection
