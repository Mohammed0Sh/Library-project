<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request_to_add_item_user extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:255'],
            'subject_id' => ['required'],
            'maintainer_id' => ['required'],
        ];
    }
}
