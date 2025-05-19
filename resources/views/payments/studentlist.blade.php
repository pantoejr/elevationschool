@foreach ($students as $student)
    <option value="{{ $student->student_id }}"> {{ $student->student->first_name . ' ' . $student->student->middle_name . ' ' . $student->student->last_name}} </option>
@endforeach