<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
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
            'dateEnvoi' => 'required|date',
            //'heureEnvoi' => 'required|trime',
            'message' => 'required|string|min:5|max:480',
            'campagne_id' => 'required|integer|exists:campagnes,id',
        ];
    }
}
