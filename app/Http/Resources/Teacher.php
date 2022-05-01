<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
//use App\Http\Resources\SchoolTeacher as SchoolTeacherResource;



use Carbon\Carbon;

class Teacher extends JsonResource
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
            //'user_id' => $this->user_id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'birthday' => $this->birthday,
            'state' => $this->state,
            'city' => $this->city,
            /*'schools' =>
                SchoolTeacherResource::collection($this->schools),*/
            'unlocked_at'=> $this->unlocked_at,
            'credentials' => new UserResource($this->user),
        ];
    }
}
