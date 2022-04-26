<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Resources\Teacher as TeacherResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'user_type' => 'Professor',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $dados = $request->all();
        $teacher = Teacher::create($dados);
        $teacher->user_id = $user->id;
        $teacher->save();
        return new TeacherResource($teacher);
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

        if (Arr::exists($request->all(), 'email')) {
            $validator = Validator::make($request->all(),[
                'email' => 'required|string|email|max:255|unique:users'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $teacher->user()
                ->update(['email' => Arr::get($request->all(), 'email')]);
        }
        if (Arr::exists($request->all(), 'password')) {
            $validator = Validator::make($request->all(),[
                'password' => 'required|string|min:8'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $teacher->user()
                ->update(['password' => Hash::make(Arr::get($request->all(), 'password'))]);
        }
        return json_encode('Dados alterados!');
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
        $user_id = $teacher->user_id;
        $user = User::find($user_id);
        $user->delete();
        $teacher->delete();
        return json_encode('Professor apagado!');
    }
}
