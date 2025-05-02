@extends('layouts.admin')
@section('content')
    @php
        $sections = [
            [
                'id' => 'section1',
                'title' => 'Details',
                'view' => 'sections.partials.show',
                'icons' => 'person',
            ],
            [
                'id' => 'section2',
                'title' => 'Installment',
                'view' => 'sections.partials.installment',
                'icons' => 'book',
            ]
        ];
    @endphp

    @can('view-section-details')
        <x-section-navigation :sections="$sections" :model="$section" :installments="$installments" />
    @endcan
@endsection
