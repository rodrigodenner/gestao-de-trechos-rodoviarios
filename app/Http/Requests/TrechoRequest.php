<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrechoRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'data_referencia' => 'required|date',
      'uf_id' => 'required|exists:ufs,id',
      'rodovia_id' => 'required|exists:rodovias,id',
      'kmInicial' => 'required|numeric|min:0',
      'kmFinal' => 'required|numeric|gte:kmInicial',
      'tipo' => 'required|string',
    ];
  }
}

