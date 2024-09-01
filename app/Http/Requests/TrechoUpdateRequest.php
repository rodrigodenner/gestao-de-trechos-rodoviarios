<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrechoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data_referencia' => 'sometimes|date',
            'uf_id' => 'sometimes|exists:ufs,id',
            'rodovia_id' => 'sometimes|exists:rodovias,id',
            'kmInicial' => 'sometimes|numeric|min:0',
            'kmFinal' => 'sometimes|numeric|gte:kmInicial',
            'tipo' => 'sometimes|string',
        ];
    }
}
