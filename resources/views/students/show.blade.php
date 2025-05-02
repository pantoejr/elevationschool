@extends('layouts.admin')
@section('content')
    @php
        $sections = [
            [
                'id' => 'section1',
                'title' => 'Details',
                'view' => 'students.partials.show',
                'icons' => 'person',
            ],
            [
                'id' => 'section2',
                'title' => 'Sections',
                'view' => 'students.partials.sections',
                'icons' => 'clock',
            ],
            [
                'id' => 'section3',
                'title' => 'Documents',
                'view' => 'students.partials.attachments',
                'icons' => 'file',
            ],
        ];
    @endphp

    @can('view-section-details')
        <x-section-navigation :sections="$sections" :model="$student" :classSections="$classSections" />
    @endcan
@endsection
