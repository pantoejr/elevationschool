<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Installment;
use App\Models\Section;
use App\Models\SectionInstallment;
use App\Models\Student;
use App\Models\StudentSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $sections = Section::all();

        return view('sections.index', [
            'title' => 'Sections',
            'sections' => $sections,
        ]);
    }

    public function create()
    {
        $courses = Course::all();
        $faculties = Faculty::all();

        return view('sections.create', [
            'title' => 'Create Section',
            'faculties' => $faculties,
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections,name,except,id',
            'course_id' => 'required|exists:courses,id',
            'faculty_id' => 'required|exists:faculties,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'max_students' => 'required|numeric',
            'course_cost' => 'required|numeric',
            'currency' => 'required|in:USD,LRD',
            'schedule' => 'required|array',
            'schedule.*.day' => 'required|string',
            'schedule.*.start_time' => 'required',
            'schedule.*.end_time' => 'required',
            'schedule.*.location' => 'required|string',
        ]);

        try {

            Section::create([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'faculty_id' => $request->faculty_id,
                'max_students' => $request->max_students,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'schedule' => $request->schedule,
                'course_cost' => $request->course_cost,
                'currency' => $request->currency,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);

            return to_route('sections.index')->with('success', 'Section created successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            return back()->with('success', 'Error creating section: '.$ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function edit(Section $section)
    {
        $courses = Course::all();
        $faculties = Faculty::all();

        return view('sections.edit', [
            'title' => 'Edit Section',
            'section' => $section,
            'faculties' => $faculties,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|unique:sections,name,'.$section->id,
            'course_id' => 'required|exists:courses,id',
            'faculty_id' => 'required|exists:faculties,id',
            'max_students' => 'required|numeric',
            'course_cost' => 'required|numeric',
            'currency' => 'required|in:USD,LRD',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'schedule' => 'required|array',
            'schedule.*.day' => 'required|string',
            'schedule.*.start_time' => 'required',
            'schedule.*.end_time' => 'required',
            'schedule.*.location' => 'required|string',
        ]);

        try {
            $section->update([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'faculty_id' => $request->faculty_id,
                'start_date' => $request->start_date,
                'max_students' => $request->max_students,
                'course_cost' => $request->course_cost,
                'currency' => $request->currency,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'schedule' => $request->schedule,
                'updated_by' => Auth::user()->name,
            ]);

            return to_route('sections.index')->with('success', 'Section updated successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            return back()->with('success', 'Error updating section: '.$ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function show(Section $section)
    {

        $assignInstallmentsId = SectionInstallment::where('section_id', $section->id)
            ->pluck('installment_id');

        $installments = Installment::whereNotIn('id', $assignInstallmentsId)
            ->get();

        return view('sections.show', [
            'title' => 'Section Details',
            'section' => $section,
            'installments' => $installments,
        ]);
    }

    public function destroy(Section $section)
    {
        try {
            $section->delete();

            return to_route('sections.index')->with('success', 'Section deleted successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            return back()->with('success', 'Error deleting section: '.$ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function toggleStatus(Section $section)
    {
        $section->status = $section->status === 'active' ? 'inactive' : 'active';
        $section->save();

        return to_route('sections.index')->with('success', 'Section status updated successfully')
            ->with('flag', 'success');
    }

    public function studentsForSection(Section $section)
    {
        $studentIds = StudentSection::where('section_id', $section->id)
            ->pluck('student_id');

        $students = Student::whereIn('id', $studentIds)
            ->select('id', 'last_name', 'first_name', 'middle_name')
            ->get();

        return response()->json([
            'students' => $students,
        ]);
    }
}
