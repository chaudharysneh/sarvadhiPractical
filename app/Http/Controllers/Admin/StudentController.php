<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('full_name')->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'unique_id' => ['required', 'string', 'min:6', 'max:12', 'regex:/^[A-Za-z0-9]+$/', 'unique:students,unique_id'],
            'full_name' => 'required|string|max:255',
            'parent_contact_number' => 'required|string|max:20',
            'parent_email' => 'required|email',
            'dob' => 'required|date|before:today',
            'date_of_join' => 'required|date',
            'weekly_max_hours' => 'required|numeric|min:0',
            'daily_max_hours' => 'required|numeric|min:0',
        ]);
        $password = $request->validate(['password' => 'required|min:6|confirmed'])['password'];

        $student = Student::create($data);
        User::create([
            'unique_id' => $student->unique_id,
            'name' => $student->full_name,
            'email' => null,
            'password' => Hash::make($password),
            'role' => 'student',
            'role_id' => $student->id,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'unique_id' => ['required', 'string', 'min:6', 'max:12', 'regex:/^[A-Za-z0-9]+$/', Rule::unique('students')->ignore($student->id)],
            'full_name' => 'required|string|max:255',
            'parent_contact_number' => 'required|string|max:20',
            'parent_email' => 'required|email',
            'dob' => 'required|date|before:today',
            'date_of_join' => 'required|date',
            'weekly_max_hours' => 'required|numeric|min:0',
            'daily_max_hours' => 'required|numeric|min:0',
        ]);
        $student->update($data);

        $user = User::where('role', 'student')->where('role_id', $student->id)->first();
        if ($user) {
            $user->update(['unique_id' => $student->unique_id, 'name' => $student->full_name]);
            if ($request->filled('password')) {
                $request->validate(['password' => 'min:6|confirmed']);
                $user->update(['password' => Hash::make($request->password)]);
            }
        }

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        User::where('role', 'student')->where('role_id', $student->id)->delete();
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
