<?php

namespace App\Http\Controllers;

use App\Models\SystemVariable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SystemVariableController extends Controller
{
    public function index()
    {
        $systemVariables = SystemVariable::all();
        return view('system_variables.index', [
            'title' => 'System Variables',
            'systemVariables' => $systemVariables,
        ]);
    }

    public function create()
    {
        return view('system_variables.create', [
            'title' => 'Create System Variable',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:shortname,name,logo,favicon,email,phone,contact,address',
            'value' => 'required',
        ]);
        try {

            if ($validatedData['type'] === 'logo' || $validatedData['type'] === 'favicon' && $request->hasFile('value')) {
                $filePath = $request->file('value')->store('system_variables', 'public');
                $validatedData['value'] = $filePath;
            }

            $systemVariable = new SystemVariable([
                'type' => $validatedData['type'],
                'value' => $validatedData['value'],
                'created_by' => Auth::user()->name ?? 'N/A',
                'updated_by' => Auth::user()->name ?? 'N/A',
            ]);

            $systemVariable->save();

            return redirect()->route('variables.index')
                ->with('success', 'System variable created successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            Log::error('Error creating system variable: ' . $ex->getMessage());

            return back()->with('success', 'Error: ' . $ex->getMessage())
                ->with('flag', 'danger');
        }
    }

    public function destroy(SystemVariable $systemVariable)
    {
        $systemVariable->delete();
        return to_route('variables.index')
            ->with('success', 'System Variable deleted successfully')
            ->with('flag', 'success');
    }
}
