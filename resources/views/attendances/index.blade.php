{{-- resources/views/attendances/index.blade.php --}}
@extends('layouts.admin')
@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            <a href="{{ route('attendances.create') }}"
                class="px-2 py-1 text-md rounded-sm bg-blue-600 text-white hover:bg-blue-700">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
        <div class="overflow-x-auto p-5">
            <table class="min-w-full divide-y divide-gray-200 dataTable nowrap">
                <thead>
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">No.</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Section
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Student
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{ $attendance->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $attendance->section->course->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $attendance->student->first_name }} {{ $attendance->student->middle_name }}
                                {{ $attendance->student->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">{{ ucfirst($attendance->status) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-md font-medium">
                                <a href="{{ route('attendances.edit', ['attendance' => $attendance]) }}"
                                    class="text-yellow-600 hover:text-yellow-900 mr-4">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('attendances.show', ['attendance' => $attendance]) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-4">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('attendances.destroy', ['attendance' => $attendance]) }}"
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
        </div>
    </div>
@endsection
