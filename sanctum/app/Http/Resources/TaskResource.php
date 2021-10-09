<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title' => $this->name,
            'status' => $this->is_done,
            'key' => $this->id,
            'created_at' => $this->created_at,
            'format_date' => $this->created_at->diffForHumans()
        ];
    }
}
