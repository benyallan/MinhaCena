<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
        /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'usuário';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_type' => $this->user_type,
            'email' => $this->email,
            'password' => $this->password,
            'lastAccess' => $this->lastAccess,
        ];
    }
}
