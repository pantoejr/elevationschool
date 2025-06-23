<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $attendances = Attendance::all();

        return view('attendance.index', [
            'title' => 'Attendances',
            'attendances' => $attendances,
        ]);
    }

    public function create()
    {
        $sections = Section::all();

        return view('attendances.create', [
            'title' => 'Create Attendance',
            'sections' => $sections,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id.*' => 'required|exists:students,id',
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'status.*' => 'required|in:present,absent,late',
            'note.*' => 'nullable|string',
        ]);

        Attendance::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'section_id' => $request->section_id,
                'date' => $request->date,
            ],
            [
                'status' => $request->status,
                'note' => $request->remarks,
            ]
        );

        return to_route('attendances.index')->with('success', 'Attendance recorded successfully')
            ->with('flag', 'success');
    }
}
