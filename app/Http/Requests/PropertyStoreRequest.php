<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyStoreRequest extends FormRequest
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
            'owner_email'        => 'required|email',
            'title'              => 'required|string|max:255',
            'description'        => 'required|string|max:2000',
            'address.state'      => 'required|string',
            'address.city'       => 'required|string',
            'address.district'   => 'required|string',
            'address.street'     => 'required|string',
            'address.number'     => 'required|string',
            'address.additional' => 'nullable|string',
            'features.*.type'    => 'exists:property_feature_types,id',
            'features.*.value'   => 'string|max:255'
        ];
    }
}
