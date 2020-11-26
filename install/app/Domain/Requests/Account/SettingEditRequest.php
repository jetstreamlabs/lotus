<?php

namespace App\Domain\Requests\Account;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class SettingEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! $this->user() === auth()->user()) {
            throw( new AuthorizationException());
        }

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
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->user()->id)
            ]
        ];
    }
}
