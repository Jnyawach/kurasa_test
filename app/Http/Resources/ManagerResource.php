<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'supermarket_id'=>$this->supermarket_id,
            'supermarket'=>new SupermarketResource($this->whenLoaded('supermarket')),
            'employees'=>EmployeeResource::collection($this->whenLoaded('employees')),
            'employees_count'=>$this->employees->count()
        ];
    }
}
