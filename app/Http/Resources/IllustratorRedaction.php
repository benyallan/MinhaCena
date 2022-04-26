<?php

namespace App\Http\Resources;

use App\Models\Illustrator;
use App\Http\Resources\Illustrator as IllustratorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IllustratorRedaction extends JsonResource
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
            'illustrator' =>
                new IllustratorResource(
                    Illustrator::find($this->illustrator_id)
                ),
            'illustration' => $this->illustration,
            'delivered_at' => $this->delivered_at,
            'unlocked_at' => $this->unlocked_at,
        ];
    }
}
