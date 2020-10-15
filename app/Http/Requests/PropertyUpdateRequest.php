<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyUpdateRequest extends FormRequest
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
            'owner_email'        => 'email',
            'title'              => 'string|max:255',
            'description'        => 'string|max:2000',
            'address.state'      => 'string',
            'address.city'       => 'string',
            'address.district'   => 'string',
            'address.street'     => 'string',
            'address.number'     => 'string',
            'address.additional' => 'string',
            'features.*.type'    => 'exists:property_feature_types,id',
            'features.*.value'   => 'string|max:255'
        ];
    }
}
