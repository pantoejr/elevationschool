<?php

namespace App\Http\Controllers;

use App\Models\Section;
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

    public function show($id)
    {
        $sectionInstallment = SectionInstallment::findOrFail($id);
        return response()->json($sectionInstallment);
    }

    public function store(Request $request, Section $section)
    {
        $request->validate([
            //'section_id' => 'required|exists:sections,id',
            'installment_id' => 'required|exists:installments,id',
            'amount' => 'required|numeric',
            'currency' => 'in:USD,LRD',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ]);

        $existingInstallmentsSum = SectionInstallment::where('section_id', $section->id)->sum('amount');

        $newInstallmentTotal = $existingInstallmentsSum + $request->amount;

        if ($newInstallmentTotal > $section->course_cost) {
            return back()
                ->with('success', 'The total amount of installments exceeds the section course cost.')
                ->with('flag', 'error');
        }

        try {

            SectionInstallment::create([
                'section_id' => $request->section_id,
                'installment_id' => $request->installment_id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);
        } catch (\Exception $e) {
            return back()
                ->with('success', 'An error occurred while creating the section installment: ' . $e->getMessage())
                ->with('flag', 'danger');
        }

        return redirect()->route('sections.show', ['section' => $section])
            ->with('success', 'Section Installment created successfully.')
            ->with('flag', 'success');
    }


    public function edit($id)
    {
        $sectionInstallment = SectionInstallment::findOrFail($id);
        return response()->json($sectionInstallment);
    }

    public function update(Request $request,  Section $section, SectionInstallment $installment)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'installment_id' => 'required|exists:installments,id',
            'amount' => 'required|numeric',
            'currency' => 'in:USD,LRD',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ]);


        $existingInstallmentsSum = SectionInstallment::where('section_id', $section->id)->sum('amount');


        $newInstallmentTotal = $existingInstallmentsSum + $request->amount - $installment->amount;
        // $newInstallmentTotal = $existingInstallmentsSum + $request->amount;
        // if ($newInstallmentTotal > $section->course_cost) {
        //     return back()
        //         ->with('success', 'The total amount of installments exceeds the section course cost.')
        //         ->with('flag', 'error');
        // }

        try {

            $installment->update([
                'section_id' => $section->id,
                'installment_id' => $request->installment_id,
                'amount' => $request->amount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'currency' => $request->currency,
                'updated_by' => Auth::user()->name,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the section installment: ' . $e->getMessage())
                ->with('flag', 'error');
        }

        return redirect()->route('sections.show', ['section' => $section])
            ->with('success', 'Section Installment updated successfully.')
            ->with('flag', 'success');
    }


    public function destroy(Section $section, SectionInstallment $installment)
    {
        try {
            $installment->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while deleting the section installment: ' . $e->getMessage())
                ->with('flag', 'error');
        }

        return redirect()->route('sections.show', ['section' => $section])
            ->with('success', 'Section Installment deleted successfully.')
            ->with('flag', 'success');
    }
}
