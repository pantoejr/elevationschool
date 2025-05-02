<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\SectionInstallment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        return view('home.index', [
            'title' => 'Dashboard',
            'studentsCount' => Student::count(),
            'facultiesCount' => Faculty::count(),
            'coursesCount' => Course::count(),
            'activeSectionsCount' => Section::where('status', 'active')->count(),

            'recentAttendances' => Attendance::with('student')->latest()->take(5)->get(),
            //'attendanceChartData' => $this->getAttendanceChartData(),

            'topCourses' => Course::withCount('sections')->orderBy('sections_count', 'desc')->take(5)->get(),
            'sections' => Section::with(['course', 'faculty'])->latest()->take(5)->get(),

            'upcomingInstallments' => SectionInstallment::with('section')
                ->whereDate('start_date', '>=', now())
                ->orderBy('start_date')
                ->take(5)
                ->get(),
        ]);
    }
}
