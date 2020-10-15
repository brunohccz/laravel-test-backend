<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'property' => [
                'address' => $this->property->fullAddress,
            ],
            'customer' => [
                'name'  => $this->customer->name,
                'email' => $this->customer->email,
            ],
        ];
    }
}
