<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTaskResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'task_id'=>$this->task_id,
            'due_date'=>$this->due_date,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
            'remarks'=>$this->remarks,
            'status_id'=>$this->status_id,
            'user'=>new UserResource($this->whenLoaded('user')),
            'task'=>new TaskResource($this->whenLoaded('task')),
            'status'=>$this->status
        ];
    }
}
