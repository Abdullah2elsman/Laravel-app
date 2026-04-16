<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "p_id" => $this->id,
            "p_title" => $this->id,
            "p_image" => $this->id,
            "p_desc" => $this->id,
            "p_user" => new UserResource($this->user)
        ];
    }
}
