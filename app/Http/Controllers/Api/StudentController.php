<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        $students = Student::latest()->paginate(5);
        return new StudentResource(true, 'List Data Students', $students);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'student_name' => 'required',
            'student_number' => 'required',
            'student_major' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $student = Student::create([
            'student_name' => $request->student_name,
            'student_number' =>$request->student_number,
            'student_major' => $request->student_major,
        ]);

        return new StudentResource(true, 'Student Data Succesfully Created!', $student);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'student_name' => 'required',
            'student_number' => 'required',
            'student_major' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $student = Student::find($id);

        $student->update([
            'student_name' => $request->student_name,
            'student_number' =>$request->student_number,
            'student_major' => $request->student_major,
        ]);

        return new StudentResource(true, 'Student Data Sucessfully Updated!', $student);
    }

    public function destroy($id){
        $student = Student::find($id);

        $student->delete();

        return new StudentResource(true, 'Student Data Successfully Deleted', null);
    }
}
