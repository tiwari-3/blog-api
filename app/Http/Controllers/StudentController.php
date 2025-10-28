<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    
    public function list(){
        return Student::all();
    }

    public function addStudent(Request $request){
        $rules = array(
            "name"=>"required | min:2 | max:10",
            "email"=>"email|required",
            "phone" => "required"
        );
        
        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            return $validation->errors();
        }else{
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            if($student->save()){
                return ["result" => "Student Added"];
            }else{
                return ["result" =>"operation failled"];
            }
        }
    }

    public function updateStudent(Request $request){
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if($student->save()){
            return ["result"=>"Student updated"];
        }else{
            return ["result"=>"Student not updated"];
        }
    }

    public function deleteStudent($id){
        $student = Student::destroy($id);
        if($student){
            return ['result' => "student record deleted"];
        }else{
            return ['result' => "student record not deleted"];
        }
    }

    public function searchStudent($name){
        $student = Student::where('name', 'like', "%$name%")->get();
        if($student){
            return ["result"=> $student];
        }else{
            return ["result" => "No record found"];
        }
    }
}
