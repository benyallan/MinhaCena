<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class School extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'name'=> $this->name,
            'contactPerson'=> $this->contactPerson,
            'type'=> $this->type,
            'state'=> $this->state,
            'city'=> $this->city,
            'unlocked_at'=> $this->unlocked_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'credentials' => new UserResource($this->user),
        ];
    }
}
