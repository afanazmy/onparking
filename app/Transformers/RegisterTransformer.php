<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class RegisterTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform()
    {
        return [
            'isSuccesful'   => "true",
        ];
    }
}
