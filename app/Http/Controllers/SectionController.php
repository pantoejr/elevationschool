<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Section;
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

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:sections,name,except,id',
            'course_id' => 'required|exists:courses,id',
            'faculty_id' => 'required|exists:faculties,id',
            'no_of_students' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        try{

            Section::create([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'faculty_id' => $request->faculty_id,
                'no_of_students' => $request->no_of_students,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);

            return to_route('sections.index')->with('success','Section created successfully')
            ->with('flag','success');
        }
        catch(Exception $ex){
            return back()->with('success','Error creating section: ' . $ex->getMessage())
            ->with('flag','error');
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

    public function update(Request $request, Section $section){
        $request->validate([
            'name' => 'required|unique:sections,name,'.$section->id,
            'course_id' => 'required|exists:courses,id',
            'faculty_id' => 'required|exists:faculties,id',
            'start_date' => 'nullable|date',
            'no_of_students' => 'required|numeric',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        try{
            $section->update([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'faculty_id' => $request->faculty_id,
                'start_date' => $request->start_date,
                'no_of_students' => $request->no_of_students,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'updated_by' => Auth::user()->name,
            ]);

            return to_route('sections.index')->with('success','Section updated successfully')
            ->with('flag','success');
        }
        catch(Exception $ex){
            return back()->with('success','Error updating section: ' . $ex->getMessage())
            ->with('flag','error');
        }
    }

    public function show(Section $section)
    {
        return view('sections.show', [
            'title' => 'Section Details',
            'section' => $section,
        ]);
    }

    public function destroy(Section $section)
    {
        try{
            $section->delete();
            return to_route('sections.index')->with('success','Section deleted successfully')
            ->with('flag','success');
        }
        catch(Exception $ex){
            return back()->with('success','Error deleting section: ' . $ex->getMessage())
            ->with('flag','error');
        }
    }
    
    public function toggleStatus(Section $section)
    {
        $section->status = $section->status === 'active' ? 'inactive' : 'active';
        $section->save();

        return to_route('sections.index')->with('success','Section status updated successfully')
        ->with('flag','success');
    }
}
