<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Http\Resources\School as SchoolResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SchoolResource::collection(School::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $school = School::create($request->all());
        return new SchoolResource($school);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show($school)
    {
        $school = School::find($school);
        if (is_null($school)) {
            return json_encode('Escola não existe!');
        }
        return new SchoolResource($school);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $school)
    {
        $school = School::find($school);
        if (is_null($school)) {
            return json_encode('Escola não existe!');
        }
        $school->update($request->all());
        if (Arr::exists($request->all(), 'email')) {
            $school->user()
                ->update(['email' => Arr::get($request->all(), 'email')]);
        }
        if (Arr::exists($request->all(), 'password')) {
            $school->user()
            ->update(['password' => Arr::get($request->all(), 'password')]);
        }
        return new SchoolResource($school);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school = School::find($school);
        if (is_null($school)) {
            return json_encode('Escola não existe!');
        }
        $school->delete();
        return json_encode('Escola apagada!');
    }
}
