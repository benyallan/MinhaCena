<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Log extends JsonResource
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
            'redaction' => $this->redaction_id,
            'where' => $this->where,
            'who' => $this->who,
        ];
    }
}
