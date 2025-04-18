@extends('layouts.admin')
@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            <a href="{{ route('variables.create') }}" class="px-2 py-1 rounded-sm bg-blue-600 text-white hover:bg-blue-700">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            @if ($systemVariables->isEmpty())
                <p class="text-gray-700 py-4 text-center">No record found</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No.
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($systemVariables as $systemVariable)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $systemVariable->type }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('variables.edit', ['systemVariable' => $systemVariable]) }}"
                                        class="text-yellow-600 hover:text-yellow-900 mr-4">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('variables.show', ['systemVariable' => $systemVariable]) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-4">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('variables.destroy', ['systemVariable' => $systemVariable]) }}"
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
