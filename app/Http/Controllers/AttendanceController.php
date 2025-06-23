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
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent,late',
            'note' => 'nullable|array',
            'note.*' => 'nullable|string',
        ]);

        foreach ($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'section_id' => $request->section_id,
                    'date' => $request->date,
                ],
                [
                    'status' => $status,
                    'note' => $request->note[$student_id] ?? null,
                ]
            );
        }

        return to_route('attendances.index')
            ->with('success', 'Attendance recorded successfully')
            ->with('flag', 'success');
    }
}
