@extends('layouts.admin')
@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            <a href="{{ route('sections.create') }}" class="px-2 py-1 rounded-sm bg-blue-600 text-white hover:bg-blue-700">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>

        <div class="overflow-x-auto p-5">
            <table class="min-w-full divide-y divide-gray-200 dataTable nowrap">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Course
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Max Students
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            No of Student Enrolled
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Instructor
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($sections as $section)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $section->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $section->course->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $section->max_students }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $section->no_of_students }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-md leading-5 font-semibold rounded-full 
                                  {{ $section->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($section->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $section->faculty->full_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-md font-medium">
                                <a href="{{ route('sections.edit', ['section' => $section]) }}"
                                    class="text-yellow-600 hover:text-yellow-900 mr-4">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('sections.show', ['section' => $section]) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-4">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('sections.destroy', ['section' => $section]) }}"
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
    </div>
@endsection
