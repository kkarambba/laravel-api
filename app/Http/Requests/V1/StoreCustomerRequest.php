<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');

        //return $user != null && $user->tokenCan('customer:create');
        //return $user != null && $user->tokenCan('invoice:create');
        //return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'type' => ['required', Rule::in(['I','B','i','b'])],
            'email' => ['required','email'],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'postCode' => ['required'],
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'postcode' => $this->postCode,
        ]);
    }
}
