<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\User;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class FacultyController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    public function index(){
        $faculties = Faculty::all();
        return view('faculties.index', [
            'title' => 'Faculties',
            'faculties' => $faculties
        ]);
    }


    public function create(){
        $roles = Role::all();
        return view('faculties.create', [
            'title' => 'Create Faculty',
            'roles' => $roles
        ]);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:faculties,email',
            'roleId' => 'required|exists:roles,id',
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png,jpg|max:5120',
        ]);

        try {           

            if ($request->hasFile('photo')) {
                $photoPath = $this->uploadFile($request->file('photo'), 'faculty/photos');
                $validated['photo'] = $photoPath;
            }

            $newUser = User::create([
                'name' => $validated['full_name'],
                'photo' => $photoPath ?? 'N/A',
                'email' => $validated['email'],
                'status' => $validated['status'],
                'password' => Hash::make($validated['email']),
                'login_hint' => $validated['email'],
            ]);

            $validated['created_by'] = Auth::user()->name;
            $validated['updated_by'] = Auth::user()->name;
            $validated['user_id'] = $newUser->id;

            $faculty = Faculty::create($validated);
            $role = Role::findById($request->roleId);
            $newUser->assignRole($role);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    $attachmentPath = $this->uploadFile($attachment, 'faculty/attachments');
                    
                    $faculty->attachments()->create([
                        'file_path' => $attachmentPath,
                        'file_name' => $attachment->getClientOriginalName(),
                        'file_type' => $attachment->getClientMimeType(),
                        'created_by' => Auth::user()->name,
                        'updated_by' => Auth::user()->name,
                    ]);
                }
            }

            return redirect()->route('faculties.index')
                ->with('success', 'Faculty member created successfully!')
                ->with('flag', 'success');

        } catch (\Exception $e) {
           
            if (isset($photoPath)) {
                Storage::delete($photoPath);
            }
            if (isset($attachmentPaths)) {
                foreach ($attachmentPaths as $path) {
                    Storage::delete($path);
                }
            }

            return back()->withInput()
                ->with('success', 'Error creating faculty member: ' . $e->getMessage())
                ->with('flag', 'error');
        }
    }

    public function edit(Faculty $faculty){
        $roles = Role::all();
        return view('faculties.edit',[
            'title' => 'Edit Faculty',
            'faculty' => $faculty,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, Faculty $faculty){
        $validated = $request->validate([
            'full_name' => 'required',
            'dob' => 'required|date',
            'phone' => 'required',
            'gender' => 'required',
            'roleId' => 'required|exists:roles,id',
            'email' => 'required',
            'address' => 'required|string',
            'status' => 'required|in:active, inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try{
            if($request->hasFile('photo')){
                $photoPath = $this->uploadFile($request->file('photo'), 'faculty/photos');
                $validated['photo'] = $photoPath;
            }

            if(empty($faculty->photo)){
                Storage::delete($faculty->photo);
            }
            $faculty->update([
                'full_name' => $validated['full_name'],
                'dob' => $validated['dob'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'address' => $validated['address'],
                'photo' => $validated['photo'],
                'status' => $validated['status'],
                'updated_by' => Auth::user()->name,
            ]);

            $user = User::findOrFail($faculty->user_id);
            $role = Role::findById($request->roleId);
            $user->syncRoles($role);

        }
        catch(Exception $ex){
            return back()
                ->with('success', 'Error updating faculty member: ' . $ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function show(Faculty $faculty){
        $roles = Role::all();
        return view('faculties.show',[
            'title' => 'Faculty Details',
            'faculty' => $faculty,
            'roles' => $roles,
        ]);
    }

    public function destroy($id){
        $faculty = Faculty::findOrFail($id);
        $user = User::findOrFail($faculty->user_id);
        $user->delete();
        $faculty->delete();
        return redirect()->route('faculties.index')
                ->with('success', 'Faculty member created successfully!')
                ->with('flag', 'success');
    }

    private function uploadFile($file, $directory)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::slug($originalName) . '-' . uniqid() . '.' . $extension;
        
        return $file->storeAs($directory, $fileName, 'public');
    }
}
