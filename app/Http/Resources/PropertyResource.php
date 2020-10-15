<?php

namespace App\Http\Resources;

use App\Property;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'email'     => $this->owner_email,
            'address'   => $this->fullAddress,
            'status'    => $this->status === Property::AVAILABLE ? 'Disponível' : 'Indisponível'
        ];
    }
}
