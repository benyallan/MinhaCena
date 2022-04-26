<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\School as SchoolResource;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\RedactionTag as RedactionTagResource;

class Redaction extends JsonResource
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
            'title' => $this->title,
            'student' => $this->student,
            'school' => new SchoolResource($this->school),
            'teacher' => new TeacherResource($this->teacher),
            'composing' => $this->composing,
            'tags' =>
                RedactionTagResource::collection($this->redactiontags),
        ];
    }
}
