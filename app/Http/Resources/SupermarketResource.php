<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupermarketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'town'=>$this->town,
            'country'=>$this->country,
            'managers'=>ManagerResource::collection($this->whenLoaded('managers')),
            'supplier'=>SupplierResource::collection($this->whenLoaded('suppliers')),
            'managers_count'=>$this->managers->count(),
            'suppliers_count'=>$this->suppliers->count()
        ];
    }
}
