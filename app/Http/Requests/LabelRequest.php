<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:labels|max:255',
            'description' => 'nullable|max:1000'
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        $errors = $validator->errors()->all();
//        $errorMessage = implode(' ', $errors);
//        flash($errorMessage)->error();
//
//        throw new HttpResponseException(
//            redirect()->back()->withInput()
//        );
//    }
}
