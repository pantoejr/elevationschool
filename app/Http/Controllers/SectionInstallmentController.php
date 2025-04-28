<?php

namespace App\Http\Controllers;

use App\Models\SectionInstallment;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SectionInstallmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $sectionInstallment = SectionInstallment::all();
        return view('sectionInstallment.index', [
            'title' => 'Section Installment',
            'courses' => $sectionInstallment,
        ]);
    }

    public function show($id)
    {
        $sectionInstallment = SectionInstallment::findOrFail($id);
        return view('sectionInstallment.show', [
            'title' => 'Section Installment',
            'sectionInstallment' => $sectionInstallment,
        ]);
    }

    public function create()
    {
        return view('sectionInstallment.create', [
            'title' => 'Create Section Installment',
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        try {
            SectionInstallment::create([
                'section_id' => $request->section_id,
                'amount' => $request->amount,
                'due_date' => $request->due_date,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while creating the section installment: ' . $e->getMessage())
                ->with('flag', 'danger');
        }

        return redirect()->route('sectionInstallment.index')
            ->with('success', 'Section Installment created successfully.')
            ->with('flag', 'success');
    }
    public function edit($id)
    {
        $sectionInstallment = SectionInstallment::findOrFail($id);
        return view('sectionInstallment.edit', [
            'title' => 'Edit Section Installment',
            'sectionInstallment' => $sectionInstallment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        try {
            $sectionInstallment = SectionInstallment::findOrFail($id);
            $sectionInstallment->update([
                'section_id' => $request->section_id,
                'amount' => $request->amount,
                'due_date' => $request->due_date,
                'updated_by' => Auth::user()->name,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the section installment: ' . $e->getMessage())
                ->with('flag', 'danger');
        }

        return redirect()->route('sectionInstallment.index')
            ->with('success', 'Section Installment updated successfully.')
            ->with('flag', 'success');
    }   
    public function destroy($id)
    {
        try {
            $sectionInstallment = SectionInstallment::findOrFail($id);
            $sectionInstallment->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while deleting the section installment: ' . $e->getMessage())
                ->with('flag', 'danger');
        }

        return redirect()->route('sectionInstallment.index')
            ->with('success', 'Section Installment deleted successfully.')
            ->with('flag', 'success');
    }
}
