<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\UserRepository;

class UpdateUserPasswordRequest extends FormRequest
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
    public function rules(UserRepository $userRepository)
    {
        if(!empty($this->user))
            $id = $this->user;

        $user = $userRepository->getById($id);
        return [ 
            'password' => 'required|confirmed|min:6',
            'old_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('L\'ancien mot de passe est incorrect'));
                }
            }],
        ];
      
    }
}
