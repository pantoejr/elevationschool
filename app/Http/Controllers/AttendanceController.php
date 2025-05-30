<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(){
        return view('attendance.index', [
            'title' => 'Attendance',
        ]);
    }
}
