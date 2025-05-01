<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class StudentSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request, Student $student)
    {
        try {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'section_id' => 'required|exists:sections,id',
                'status' => 'required|in:active,inactive',
            ]);



            StudentSection::create([
                'student_id' => $request->student_id,
                'section_id' => $request->section_id,
                'status' => $request->status,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);

            return to_route('students.show', ['student' => $student])
                ->with('success', 'Student added to section successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            return back()
                ->with('success', 'Error adding student to section: ' . $ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function edit($id){
        $studentSection = StudentSection::findOrFail($id);
        return response()->json([
            'studentSection' => $studentSection,
        ]);
    }
}
