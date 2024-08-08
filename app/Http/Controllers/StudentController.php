<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function add()
    {
        $teacher = Teacher::all();
        // dd($teacher);
        return view('pages.student.add', compact('teacher'));
    }

    // store student data
    public function studentformdata(Request $request)
    {
        // dd($request->all());
        try {
            $rules = [
                'student_name' => 'required|string|max:255',
                'class_teacher_id' => 'required',
                'class' => 'required|string',
                'yearly_fees' => 'required|numeric',
                'admission_date' => 'required|date',
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            DB::beginTransaction();

            $student = Student::create([
                'student_name' => $request->student_name,
                'class_teacher_id' => $request->class_teacher_id,
                'class' => $request->class,
                'yearly_fees' => $request->yearly_fees,
                'admission_date' => $request->admission_date
            ]);

            DB::commit();

            return response()->json(['message' => 'Student added successfully', 'success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the data', 'error' => $e->getMessage()]);
        }
    }

    public function editstudent($id)
    {
        $teacher = Teacher::all();
        $student = Student::with('teacher')->where('id', $id)->first();
        return view('pages.student.edit', compact('teacher', 'student'));
    }

    // update student data
    public function updatestudentform(Request $request)
    {
        // dd($request->all());
        try {
            $rules = [
                'student_name' => 'required|string|max:255',
                'class_teacher_id' => 'required',
                'class' => 'required|string',
                'yearly_fees' => 'required|numeric',
                'admission_date' => 'required|date',
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            DB::beginTransaction();

            $student = Student::where('id', $request->stuId)->update([
                'student_name' => $request->student_name,
                'class_teacher_id' => $request->class_teacher_id,
                'class' => $request->class,
                'yearly_fees' => $request->yearly_fees,
                'admission_date' => $request->admission_date
            ]);

            DB::commit();

            return response()->json(['message' => 'Student updated successfully', 'success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the data', 'error' => $e->getMessage()]);
        }
    }

    public function deletestudent(Request $request){
        // dd($request->all());
        $student = Student::where('id',$request->user_id)->delete();
        return response()->json(['message' => 'Student updated successfully', 'success' => true, 'status' => 200]);
    }


}
