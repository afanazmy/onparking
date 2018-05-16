<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Operator;

class OperatorTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Operator $operator)
    {
        return [
            'id'                =>  $operator->id,
            'operator_number'   =>  $operator->operator_number,
            'registered'        =>  $operator->created_at->diffForHumans(),
        ];
    }
}
