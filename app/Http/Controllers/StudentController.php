<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(){
        $students = Student::all();
        return view('students.index',[
            'title' => 'Students',
            'students' => $students,
        ]);
    }

    public function create(){
        $sections = Section::with('course')->where('status','active')->get();
        return view('students.create',[
            'title' => 'Create Student',
            'sections' => $sections,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
    }
}
