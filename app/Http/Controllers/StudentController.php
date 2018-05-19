<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;
use App\User;
use App\Vehicle;
use App\Transformers\VehicleTransformer;
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
        //dd($student);

        $this->authorize('updateStudent', $student);

        $this->validate($request, [
            'name'      => 'required',
            'nif'       => 'required',
            'majors'    => 'required',
        ]);

        $student->name      = $request->get('name', $student->name);
        $student->nif       = $request->get('nif', $student->nif);
        $student->majors    = $request->get('majors', $student->majors);
        $student->user_id   = Auth::user()->id;
        $student->save();

        return fractal()
            ->item($student)
            ->transformWith(new StudentTransformer)
            ->toArray();
    }

}
