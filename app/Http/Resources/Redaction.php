<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\School as SchoolResource;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\IllustratorRedaction as IllustratorRedactionResource;
use App\Http\Resources\Tag as TagResource;
use App\Models\IllustratorRedaction;

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
            'title' => $this->title,
            'student' => $this->student,
            'school' => new SchoolResource($this->school),
            'teacher' => new TeacherResource($this->teacher),
            'composing' => $this->composing,
            'tags' =>
                TagResource::collection($this->tags),
            'illustration' =>
                IllustratorRedactionResource::collection(
                    IllustratorRedaction::where([
                            'redaction_id' => $this->id
                        ])->get()
                ),
        ];
    }
}
