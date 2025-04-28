<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use App\Models\StudentInvoice;
use App\Models\StudentSection;

class StudentInvioceController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(){
        return view('studentsInvoice.index',[
            'title' => 'Student Invoice',
        ]);
    }

    public function show($id){
        $studentInvoice = StudentInvoice::findOrFail($id);
        return view('studentsInvoice.show',[
            'title' => 'Student Invoice',
            'studentInvoice' => $studentInvoice,
        ]);
    }

    public function create(){
        return view('studentsInvoice.create',[
            'title' => 'Create Student Invoice',
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'student_section_id' => 'required|exists:student_sections,id',
            'amount_paid' => 'required|numeric',
            'due_date' => 'required|date',
            'currency' => 'required|string|max:3',
        ]);

        try {
            StudentInvoice::create([
                'student_section_id' => $request->student_section_id,
                'amount_paid' => $request->amount_paid,
                'balance' => $request->balance,
                'due_date' => $request->due_date,
                'currency' => $request->currency,
                'is_completed' => $request->is_completed,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while creating the student invoice: ' . $e->getMessage());
        }

        return redirect()->route('studentsInvoice.index')
            ->with('success', 'Student invoice created successfully.');
    }

    public function edit($id){
        $studentInvoice = StudentInvoice::findOrFail($id);
        return view('studentsInvoice.edit',[
            'title' => 'Edit Student Invoice',
            'studentInvoice' => $studentInvoice,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'student_section_id' => 'required|exists:student_sections,id',
            'amount_paid' => 'required|numeric',
            'balance' => 'required|numeric',
            'due_date' => 'required|date',
            'currency' => 'required|string|max:3',
            'is_completed' => 'required|boolean',
        ]);

        try {
            $studentInvoice = StudentInvoice::findOrFail($id);
            $studentInvoice->update([
                'student_section_id' => $request->student_section_id,
                'amount_paid' => $request->amount_paid,
                'balance' => $request->balance,
                'due_date' => $request->due_date,
                'currency' => $request->currency,
                'is_completed' => $request->is_completed,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the student invoice: ' . $e->getMessage());
        }

        return redirect()->route('studentsInvoice.index')
            ->with('success', 'Student invoice updated successfully.');
    }   

    public function destroy($id){
        try {
            $studentInvoice = StudentInvoice::findOrFail($id);
            $studentInvoice->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while deleting the student invoice: ' . $e->getMessage());
        }

        return redirect()->route('studentsInvoice.index')
            ->with('success', 'Student invoice deleted successfully.');
    }

}
