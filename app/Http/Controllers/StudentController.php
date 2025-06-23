<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentSection;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $students = Student::all();

        return view('students.index', [
            'title' => 'Students',
            'students' => $students,
        ]);
    }

    public function create()
    {
        $sections = Section::with('course')->where('status', 'active')->get();

        return view('students.create', [
            'title' => 'Create Student',
            'sections' => $sections,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'required|string',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:Male,Female,Unknown',
                'marital_status' => 'required|in:Single,Married,Engaged,Divorced',
                'place_of_birth_town' => 'required|string',
                'place_of_birth_city' => 'required|string',
                'place_of_birth_country' => 'required|string',
                'nationality' => 'required|string',
                'official_language' => 'nullable|string',
                'permanent_address_town' => 'nullable|string',
                'permanent_address_city' => 'nullable|string',
                'permanent_address_country' => 'nullable|string',
                'mobile_phone' => 'required',
                'email' => 'required',
                'father_name' => 'required|string',
                'mother_name' => 'required|string',
                'emergency_contact_name' => 'required|string',
                'emergency_contact_number' => 'required|string',
                'computer_literacy' => 'required|in:Beginner,Intermediate,Advanced,Professional',
                'status' => 'required|in:active,inactive',
                'section_id' => 'required|exists:sections,id',
                'attachments.*' => 'nullable',
            ]);

            $section = Section::findOrFail($request->section_id);
            $courseName = $section->course->name ?? null;

            if ($request->hasFile('photo')) {
                $photoPath = $this->uploadFile($request->file('photo'), 'students/photos');
                $request['photo'] = $photoPath;
            }

            $student = Student::create([
                'photo' => $photoPath ?? 'N/A',
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'place_of_birth_town' => $request->place_of_birth_town,
                'place_of_birth_city' => $request->place_of_birth_city,
                'place_of_birth_country' => $request->place_of_birth_country,
                'nationality' => $request->nationality,
                'official_language' => $request->official_language,
                'permanent_address_town' => $request->permanent_address_town,
                'permanent_address_city' => $request->permanent_address_city,
                'permanent_address_country' => $request->permanent_address_country,
                'mobile_phone' => $request->mobile_phone,
                'email' => $request->email,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_number' => $request->emergency_contact_number,
                'computer_literacy' => $request->computer_literacy,
                'education_status' => $request->education_status,
                'course_applying_for' => $courseName,
                'is_new' => $request->is_new ? 1 : 0,
                'status' => $request->status,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);

            if ($request->hasFile('attachments')) {
                $this->handleStudentAttachments($request->file('attachments'), $student);
            }

            $section->no_of_students += 1;
            $section->save();

            StudentSection::create([
                'student_id' => $student->id,
                'section_id' => $request->section_id,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);

            DB::commit();

            return to_route('students.index')
                ->with('success', 'Student inserted successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            DB::rollBack();

            return back()->with('success', 'Error inserting student record '.$ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'title' => 'Edit Student',
            'student' => $student,
        ]);
    }

    public function update(Request $request, Student $student)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'required|string',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:Male,Female,Unknown',
                'marital_status' => 'required|in:Single,Married,Engaged,Divorced',
                'place_of_birth_town' => 'required|string',
                'place_of_birth_city' => 'required|string',
                'place_of_birth_country' => 'required|string',
                'nationality' => 'required|string',
                'official_language' => 'nullable|string',
                'permanent_address_town' => 'nullable|string',
                'permanent_address_city' => 'nullable|string',
                'permanent_address_country' => 'nullable|string',
                'mobile_phone' => 'required',
                'email' => 'required',
                'father_name' => 'required|string',
                'mother_name' => 'required|string',
                'emergency_contact_name' => 'required|string',
                'emergency_contact_number' => 'required|string',
                'computer_literacy' => 'required|in:Beginner,Intermediate,Advanced,Professional',
                'status' => 'required|in:active,inactive',
            ]);

            if ($request->hasFile('photo')) {
                $photoPath = $this->uploadFile($request->file('photo'), 'students/photos');
                $request['photo'] = $photoPath;
            }

            $student->update([
                'photo' => $photoPath ?? 'N/A',
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'place_of_birth_town' => $request->place_of_birth_town,
                'place_of_birth_city' => $request->place_of_birth_city,
                'place_of_birth_country' => $request->place_of_birth_country,
                'nationality' => $request->nationality,
                'official_language' => $request->official_language,
                'permanent_address_town' => $request->permanent_address_town,
                'permanent_address_city' => $request->permanent_address_city,
                'permanent_address_country' => $request->permanent_address_country,
                'mobile_phone' => $request->mobile_phone,
                'email' => $request->email,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_number' => $request->emergency_contact_number,
                'computer_literacy' => $request->computer_literacy,
                'education_status' => $request->education_status,
                'is_new' => $request->is_new,
                'status' => $request->status,
                'updated_by' => Auth::user()->name,
            ]);

            DB::commit();

            return to_route('students.index')
                ->with('success', 'Student record updated successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            DB::rollBack();

            return back()->with('success', 'Error updating student record '.$ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function show(Student $student)
    {
        $assignedSectionIds = StudentSection::where('student_id', $student->id)
            ->pluck('section_id');
        $sections = Section::where('status', 'active')
            ->whereNotIn('id', $assignedSectionIds)
            ->get();

        return view('students.show', [
            'student' => $student,
            'title' => 'Student Details',
            'classSections' => $sections,
        ]);
    }

    public function destroy(Student $student)
    {
        Storage::delete($student->photo);
        $student->delete();

        return to_route('students.index')
            ->with('success', 'Student deleted successfully')
            ->with('flag', 'success');
    }

    public function destroyStudentAttachment(Student $student, Attachment $attachment)
    {
        // if ($attachment->attachmentable()->student->id !== $student->id) {
        //     abort(403, 'Unauthorized action: This attachment does not belong to the specified student');
        // }
        DB::beginTransaction();
        try {
            $filePath = $attachment->file_path;

            $attachment->delete();

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            } else {
                Log::warning("File not found during deletion attempt: {$filePath}");
            }

            DB::commit();

            return redirect()
                ->route('students.show', ['student' => $student])
                ->with('success', 'Attachment deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('students.show', ['student' => $student])
                ->with('error', 'Failed to delete attachment. Please try again.');
        }
    }

    public function storeStudentAttachment(Request $request, Student $student)
    {
        try {
            $request->validate([
                'attachments.*' => 'required',
            ]);
            $this->handleStudentAttachments($request->file('attachments'), $student);

            return to_route('students.show', ['student' => $student])
                ->with('success', 'Student document uploaded successfully')
                ->with('flag', 'success');
        } catch (Exception $ex) {
            return back()->with('success', 'Error uploading file'.$ex->getMessage())
                ->with('flag', 'error');
        }
    }

    public function showStudentAttachment(Attachment $attachment)
    {
        if (! Storage::disk('public')->exists($attachment->file_path)) {
            abort(404, 'File not found');
        }

        $filename = $attachment->original_name ?? basename($attachment->file_path);
        $mimeType = Storage::disk('public')->mimeType($attachment->file_path);

        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $filePath = Storage::disk('public')->path($attachment->file_path);

        return response()->download($filePath, $filename, $headers);
    }

    private function uploadFile($file, $directory)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::slug($originalName).'-'.uniqid().'.'.$extension;

        return $file->storeAs($directory, $fileName, 'public');
    }

    private function handleStudentAttachments($attachments, $student)
    {
        foreach ($attachments as $attachment) {
            $attachmentPath = $this->uploadFile($attachment, 'students/attachments');
            $student->attachments()->create([
                'file_path' => $attachmentPath,
                'file_name' => $attachment->getClientOriginalName(),
                'file_type' => $attachment->getClientMimeType(),
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);
        }
    }

    public function downloadProfilePdf(Student $student)
    {
        return Pdf::loadView('students.pdf', ['model' => $student])
            ->setPaper('A4', 'portrait')
            ->download('student_profile_'.$student->first_name.'_'.$student->last_name.'_'.now()->format('Ymd').'.pdf');
    }
}
