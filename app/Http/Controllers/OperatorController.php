<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Operator;
use App\User;
use App\Transformers\OperatorTransformer;
use Auth;

class OperatorController extends Controller
{
    public function update(Request $request, Operator $operator)
    {
        //dd($operator);

        $this->authorize('updateOperator', $operator);

        $this->validate($request, [
            'name'              => 'required',
            'operator_number'   => 'required',
        ]);

        $operator->name                = $request->get('name', $operator->name);
        $operator->operator_number     = $request->get('operator_number', $operator->operator_number);
        $operator->user_id             = Auth::user()->id;
        $operator->save();

        return fractal()
            ->item($operator)
            ->transformWith(new OperatorTransformer)
            ->toArray();
    }
}
