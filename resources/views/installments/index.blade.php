@extends('layouts.admin')
@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            @can('add-installment')
                <a href="{{ route('installments.create') }}"
                    class="px-2 py-1 rounded-sm bg-blue-600 text-white hover:bg-blue-700">
                    <i class="fas fa-plus-circle"></i>
                </a>
            @endcan
        </div>

        <div class="overflow-x-auto p-5">
            @if ($installments->isEmpty())
                <p class="text-center text-gray-700 mb-3 mt-3">No record found</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 dataTable nowrap">
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
                                class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($installments as $installment)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                    {{ $installment->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-md font-medium">
                                    <a href="{{ route('installments.edit', ['installment' => $installment]) }}"
                                        class="text-yellow-600 hover:text-yellow-900 mr-4">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('installments.show', ['installment' => $installment]) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-4">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('installments.destroy', ['installment' => $installment]) }}"
                                        style="display: inline-block">
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
