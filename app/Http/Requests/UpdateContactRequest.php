<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'nom' => 'required|string|min:5|max:255',
            'prenom' => 'required|string|min:5|max:255',
            'date_naissance' => 'required|date',
            'telephone' => 'required|string|min:8|max:20',
            'email' => 'required|email|max:255',
            'date_relance' => 'required|date|max:255',
            'repertoire_id' => 'required|integer',
            'ville_id' => 'required|integer',
            'religion_id' => 'required|integer',
            'sexe_id' => 'required|integer'
        ];
    }
}
