<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use Carbon\Carbon;

class Administrator extends JsonResource
{
        /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'Administrador';

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
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'email' => new UserResource(User::find($this->user_id)),
        ];
    }
}
