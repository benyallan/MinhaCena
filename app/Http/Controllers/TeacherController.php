<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Resources\Teacher as TeacherResource;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TeacherResource::collection(Teacher::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new TeacherResource(Teacher::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($teacher)
    {
        $teacher = Teacher::find($teacher);
        if (is_null($teacher)) {
            return json_encode('Professor não existe!');
        }
        return new TeacherResource($teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacher)
    {
        $teacher = Teacher::find($teacher);
        if (is_null($teacher)) {
            return json_encode('Professor não existe!');
        }
        $teacher->update($request->all());
        return new TeacherResource($teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher)
    {
        $teacher = Teacher::find($teacher);
        if (is_null($teacher)) {
            return json_encode('Professor não existe!');
        }
        $teacher->delete();
        return json_encode('Professor apagado!');
    }
}
