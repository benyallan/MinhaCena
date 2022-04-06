<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
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
        return Teacher::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Teacher::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $teacher = Teacher::find($teacher);
        if (is_null($teacher)) {
            return json_encode('Professor não existe!');
        }
        return $teacher;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $illusteachertrator = Teacher::find($teacher);
        if (is_null($teacher)) {
            return json_encode('Professor não existe!');
        }
        $teacher->update($request->all());
        return $teacher;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher)
    {
        //$teacher = Teacher::find($teacher);
        /*
        if (is_null($teacher)) {
            return json_encode('Professor não existe!');
        }
        */
        dd($teacher);
        $user = User::find($teacher->user_id);
        //dd($user);
        $user->delete();
        return json_encode('Professor apagado!');
    }
}
