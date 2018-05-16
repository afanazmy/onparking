<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Student;

class StudentTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Student $student)
    {
        return [
            'id'        =>  $student->id,
            'name'      =>  $student->name,
            'nif'       =>  $student->nif,
            'majors'    =>  $student->majors,
            'registered'=>  $student->created_at->diffForHumans(),
        ];
    }

}
