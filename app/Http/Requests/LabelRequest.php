<?php

namespace App\Http\Requests;

use App\Models\Label;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

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
        $labelId = $this->route('label') ? $this->route('label')->id : null;

        return [
            'name' => 'required|max:255|unique:labels,name,'.$labelId,
            'description' => 'nullable|max:1000'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $errors = $validator->errors();
                if ($errors->has('name') && $errors->first('name') === 'The name has already been taken.') {
                    $errors->forget('name');
                    $errors->add('name', __('Метка с таким именем уже существует'));
                }
            }
        ];
    }
}
