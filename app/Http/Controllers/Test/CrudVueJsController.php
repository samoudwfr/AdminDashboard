<?php

namespace App\Http\Controllers\Test;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrudVueJsController extends Controller
{
    public function index(){

        return view('test.crudVueJs');
    }

    public function saveStudent(){
        $student = new Student();
        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;
        $student->save();
        return 'OK';
    }

    public function allStudents(){
        $students = Student::paginate(5);
        return response()->json($students);
    }

    public function editStudent($id){
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function updateStudent(){
        $student = Student::findOrFail(request()->id);
        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;
        $student->update();
        return 'OK';
    }

    public function deleteStudent($id){
        $student = Student::findOrFail($id)->delete();

        return 'OK';
    }

}
