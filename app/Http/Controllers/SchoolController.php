<?php

namespace App\Http\Controllers;

use App\Http\Resources\School as SchoolResource;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'user_type' => 'Escola',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $dados = $request->all();
        $school = School::create($dados);
        $school->user_id = $user->id;
        $school->save();
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
            $validator = Validator::make($request->all(),[
                'email' => 'required|string|email|max:255|unique:users'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $school->user()
                ->update(['email' => Arr::get($request->all(), 'email')]);
        }
        if (Arr::exists($request->all(), 'password')) {
            $validator = Validator::make($request->all(),[
                'password' => 'required|string|min:8'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $school->user()
                ->update(['password' => Hash::make(Arr::get($request->all(), 'password'))]);
        }
        return json_encode('Dados alterados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($school)
    {
        $school = School::find($school);
        if (is_null($school)) {
            return json_encode('Escola não existe!');
        }
        $user_id = $school->user_id;
        $user = User::find($user_id);
        $user->delete();
        $school->delete();
        return json_encode('Escola apagada!');
    }
}
