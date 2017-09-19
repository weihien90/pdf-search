<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePdfFile extends FormRequest
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
            'name' => [
                'required',
                'alpha_dash',
                'max:50',
                Rule::unique('files')->ignore($this->route('file')->id)->where(function ($query) {
                    $query->where('user_id', $this->user()->id);
                })
            ],
            'description' => 'required|max:1000'
        ];
    }
}
