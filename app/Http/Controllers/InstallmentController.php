<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class InstallmentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    
    public function index()
    {
        $installments = Installment::all();
        return view('installments.index', [
            'title' => 'Installments',
            'installments'=> $installments
        ]);
    }

    public function create()
    {
        return view('installments.create',
            [
                'title' => 'Create Installment',
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Installment::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
        ]);

        return redirect()->route('installments.index')
        ->with('success', 'Installment created successfully.')
        ->with('flag','success');
    }

    public function show(Installment $installment)
    {
        return view('installments.show', [
            'title' => 'Installment Details',
            'installment' => $installment,
        ]);
    }

    public function edit(Installment $installment)
    {
        return view('installments.edit', [
            'installment' => $installment,
            'title' => 'Edit Installment'
        ]);
    }

    public function update(Request $request, Installment $installment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $installment->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => Auth::user()->name,
        ]);
        return to_route('installments.index')
        ->with('success', 'Installment updated successfully.')
        ->with('flag','success');
    }

    public function destroy(Installment $installment)
    {
        $installment->delete();
        return to_route('installments.index')
        ->with('success', 'Installment deleted successfully.')
        ->with('flag','success');
    }
    
}
