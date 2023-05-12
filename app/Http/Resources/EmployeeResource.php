<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'gender'=>$this->gender,
            'type'=>$this->type,
            'manager_id'=>$this->manager->id,
            'manager'=>new ManagerResource($this->whenLoaded('manager'))
        ];
    }
}
