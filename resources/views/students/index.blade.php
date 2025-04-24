@extends('layouts.admin')
@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
        <a href="{{ route('students.create') }}" class="px-2 py-1 text-md rounded-sm bg-blue-600 text-white hover:bg-blue-700">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                        Full Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                @foreach ($students as $student)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $student->photo) }}"
                                        alt="Photo">
                                </div>
                                <div class="ml-4">
                                    <div class="text-md font-medium text-gray-900">{{ $student->first_name .' '. $student->middle_name .' '. $student->last_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                            {{ $student->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                              {{ $student->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-md font-medium">
                            <a href="{{ route('students.edit', ['student' => $student]) }}"
                                class="text-yellow-600 hover:text-yellow-900 mr-4">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('students.show', ['student' => $student]) }}"
                                class="text-blue-600 hover:text-blue-900 mr-4">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('students.destroy', ['student' => $student]) }}"
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
    </div>
</div>
@endsection