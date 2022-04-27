<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\SocialMedias as SocialMediasResource;
use Carbon\Carbon;

class Illustrator extends JsonResource
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
            'name' => $this->name,
            'cpf' => $this->cpf,
            'birthday' => $this->birthday,
            'state' => $this->state,
            'city' => $this->city,
            'portfolio' => $this->portfolio,
            'socialMedias' =>
                    SocialMediasResource::collection($this->socialMedias),
            'unlocked_at'=> $this->unlocked_at,
            'credentials' => new UserResource($this->user),
        ];
    }
}
