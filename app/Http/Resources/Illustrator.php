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
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'birthday' => Carbon::parse($this->birthday)->format('d/m/Y'),
            'state' => $this->state,
            'city' => $this->city,
            'portfolio' => $this->portfolio,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'credenciais' => new UserResource($this->user),
            'socialMedias' => $this->socialMedias,
        ];
    }
}
