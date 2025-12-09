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

        return view('attendances.index', [
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

    public function edit(Attendance $attendance)
    {
        $sections = Section::all();

        return view('attendances.edit', [
            'title' => 'Edit Attendance',
            'attendance' => $attendance,
            'sections' => $sections,
        ]);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
            'note' => 'nullable|string',
        ]);

        $attendance->update([
            'section_id' => $request->section_id,
            'date' => $request->date,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        return to_route('attendances.index')
            ->with('success', 'Attendance updated successfully')
            ->with('flag', 'success');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', [
            'title' => 'Attendance Details',
            'attendance' => $attendance,
        ]);
    }
}
