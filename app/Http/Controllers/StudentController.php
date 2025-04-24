<?php

namespace App\Http\Controllers;

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
        return view('students.create',[
            'title' => 'Create Student'
        ]);
    }
}
