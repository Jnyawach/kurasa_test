<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'id'=>$this->id,
            'town'=>$this->town,
            'country'=>$this->country,
            'phone'=>$this->phone,
            'supermarket_id'=>$this->supermarket_id,
            'supermarket'=>new SupermarketResource($this->whenLoaded('supermarket'))
        ];
    }
}
