@foreach ($students as $student)
    <option value="{{ $student->student_id }}"> {{ $student->student->first_name}} </option>
@endforeach