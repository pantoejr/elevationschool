@if (count($students))
    <table class="min-w-full mt-4">
        <tr>
            <th>Student</th>
            <th>Status</th>
            <th>Remarks</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->full_name }}</td>
                <td>
                    <select name="attendance[{{ $student->id }}]" class="border rounded p-1">
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                        <option value="late">Late</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="remarks[{{ $student->id }}]" class="border rounded p-1"
                        placeholder="Remarks">
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p class="text-gray-500">No students found for this section.</p>
@endif
