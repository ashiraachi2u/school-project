<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('teacher')->get(); // Eager load teachers
        return view('home', compact('students'));
    }

    public function getData()
    {
        $students = Student::with('teacher')->get(); // Load teacher data with students

        return DataTables::of($students)
            ->addColumn('teacher.name', function (Student $student) {
                return $student->teacher ? $student->teacher->name : 'N/A';
            })
            ->make(true);
    }
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->student_name = $request->input('student_name');
        $student->class = $request->input('class');
        $student->yearly_fees = $request->input('yearly_fees');
        $student->class_teacher_id = $request->input('class_teacher_id');
        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully!'
        ]);
    }
    public function edit($id)
    {
        // Fetch the student by ID
        $student = Student::find($id);

        // Fetch all teachers to populate the dropdown
        $teachers = Teacher::all();

        return response()->json([
            'student' => $student,
            'teachers' => $teachers
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'yearly_fees' => 'required|numeric',
            'admission_date' => 'required|date',
            'class_teacher_id' => 'required|integer|exists:teachers,id',
        ]);

        $student = Student::create($validated);

        return response()->json(['success' => true, 'student' => $student]);
    }
    public function destroy($id)
    {
        // Your logic to delete the student
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['success' => 'Student deleted successfully']);
    }

}