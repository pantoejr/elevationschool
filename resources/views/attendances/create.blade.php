@extends('layouts.admin')
@section('content')
    <div class="grid grid-cols-1 mx-auto">
        <div class="bg-white rounded-md shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="section_id" class="block font-medium">Section</label>
                        <select name="section_id" id="section_id"
                            class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Select Section</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block font-medium">Date</label>
                        <input type="date" name="date" id="date"
                            class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200"
                            value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div id="students-list">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Attendance</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#section_id').on('change', function() {
            let sectionId = $(this).val();
            let studentsList = $('#students-list');
            studentsList.html('Loading...');
            if (sectionId) {
                $.get(`/sections/${sectionId}/students`, function(data) {
                    console.log(data);
                    let html = `
                            <div class="border-1 border-gray-100 overflow-x-auto">
                                <table class="min-w-full mt-4 divide-y divide-gray-200 rounded-lg shadow">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Student</th>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                        `;

                    data.students.forEach(function(student) {
                        html += `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                    ${student.first_name} ${student.middle_name ?? ''} ${student.last_name}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="attendance[${student.id}]" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late">Late</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="note[${student.id}]" class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Remarks">
                                </td>
                            </tr>
                        `;
                    });

                    html += `   </tbody>
                                </table>
                            </div>
                        `;
                    studentsList.html(html);
                }, 'json');
            } else {
                studentsList.html('');
            }
        });
    </script>
@endsection
