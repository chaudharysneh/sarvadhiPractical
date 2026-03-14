<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('full_name')->paginate(15);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'unique_id' => ['required', 'string', 'min:6', 'max:12', 'regex:/^[A-Za-z0-9]+$/', 'unique:teachers,unique_id'],
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_join' => 'required|date',
            'salary_per_hour' => 'required|numeric|min:0',
        ]);
        $password = $data['password'];
        unset($data['password'], $data['password_confirmation']);

        $teacher = Teacher::create($data);
        User::create([
            'unique_id' => $teacher->unique_id,
            'email' => $teacher->email,
            'name' => $teacher->full_name,
            'password' => Hash::make($password),
            'role' => 'teacher',
            'role_id' => $teacher->id,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'unique_id' => ['required', 'string', 'min:6', 'max:12', 'regex:/^[A-Za-z0-9]+$/', Rule::unique('teachers')->ignore($teacher->id)],
            'email' => 'required|email',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_join' => 'required|date',
            'salary_per_hour' => 'required|numeric|min:0',
        ]);
        $teacher->update($data);

        $user = User::where('role', 'teacher')->where('role_id', $teacher->id)->first();
        if ($user) {
            $user->update(['unique_id' => $teacher->unique_id, 'email' => $teacher->email, 'name' => $teacher->full_name]);
            if ($request->filled('password')) {
                $request->validate(['password' => 'min:6|confirmed']);
                $user->update(['password' => Hash::make($request->password)]);
            }
        }

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        User::where('role', 'teacher')->where('role_id', $teacher->id)->delete();
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
