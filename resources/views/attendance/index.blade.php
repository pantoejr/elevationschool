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
                        <th>Date</th>
                        <th>Section</th>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->section->name }}</td>
                            <td>{{ $attendance->student->full_name }}</td>
                            <td>{{ ucfirst($attendance->status) }}</td>
                            <td>{{ $attendance->remarks }}</td>
                            <td>
                                <a href="{{ route('attendances.edit', $attendance) }}" class="text-yellow-600">Edit</a>
                                <form action="{{ route('attendances.destroy', $attendance) }}" method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
