<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;
use App\User;
use App\Transformers\StudentTransformer;
use Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function students(Student $student)
    {
        $students = $student->all();

        return fractal()
        ->collection($students)
        ->transformWith(new StudentTransformer)
        ->toArray();
    }

    public function update(Request $request, Student $student)
    {
        
    }
}
