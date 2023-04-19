<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'description'=>$this->description,
            'due_date'=>$this->due_date,
            'user_task'=>UserTaskResource::collection($this->whenLoaded('task')),
            'status'=>$this->status,
            'sub_task'=>$this->tasks()->count()
        ];
    }
}
