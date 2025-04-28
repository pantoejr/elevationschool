<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\StudentSection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $courses = Course::all();
        return view('courses.index', [
            'title' => 'Courses',
            'courses' => $courses,
        ]);
    }

    public function create()
    {
        return view('courses.create', [
            'title' => 'Create Course',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string|in:one_month,two_months,three_months,four_months,five_months,six_months',
            'description' => 'nullable|string|max:1000',
        ]);

        try {

            Course::create([
                'name' => $request->name,
                'duration' => $request->duration,
                'description' => $request->description,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while creating the course: ' . $e->getMessage())
                ->with('flag', 'danger');
        }

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.')
            ->with('flag', 'success');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', [
            'title' => 'Edit Course',
            'course' => $course,
        ]);
    }
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string|in:one_month,two_months,three_months,four_months,five_months,six_months',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            $course->update([
                'name' => $request->name,
                'duration' => $request->duration,
                'description' => $request->description,
                'updated_by' => Auth::user()->name,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the course: ' . $e->getMessage())
                ->with('flag', 'danger');
        }

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.')
            ->with('flag', 'success');
    }

    public function show(Course $course){
        return view('courses.show',[
            'title' => 'Course Details',
            'course' => $course
        ]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return to_route('courses.index')
            ->with('success', 'Course deleted successfully')
            ->with('flag', 'success');
    }

    public function courseSections($courseId){
        $courseSections = Section::where('course_id', $courseId)->get();
    }
}
