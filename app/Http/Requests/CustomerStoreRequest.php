<?php

namespace App\Http\Requests;

use App\Customer;
use App\Rules\Document;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends FormRequest
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
            'name'      => 'required|string',
            'email'     => 'required|email',
            'type'      => ['required', Rule::in([Customer::NATURAL_PERSON, Customer::LEGAL_PERSON])],
            'document'  => ['required', new Document]
        ];
    }
}
