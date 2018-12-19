<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeliculasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:movies,title',
            'rating' => 'required|numeric|between:0,10',
            'awards' => 'required|numeric|min:0',
            'length' => 'required|numeric',
            'dia' => 'required|numeric',
            'mes' => 'required|numeric',
            'anio' => 'required|numeric',
            'genre' => 'required'
        ];
    }
}
