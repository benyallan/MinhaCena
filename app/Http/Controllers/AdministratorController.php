<?php

namespace App\Http\Controllers;

use App\Http\Resources\Administrator as AdministratorResource;
use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        /*
        if ($user->user_type == 'Administrator') {
            return true;
        }
        */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdministratorResource::collection(Administrator::all());
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
            'user_type' => 'Administrator',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $dados = $request->all();
        $administrator = Administrator::create($dados);
        $administrator->user_id = $user->id;
        $administrator->save();
        return new AdministratorResource($administrator);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show($administrator)
    {
        $administrator = Administrator::find($administrator);
        if (is_null($administrator)) {
            return json_encode('Administrador não existe!');
        }
        return new AdministratorResource($administrator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $administrator)
    {
        $administrator = Administrator::find($administrator);
        if (is_null($administrator)) {
            return json_encode('Adminstrador não existe!');
        }
        $administrator->update($request->all());

        if (Arr::exists($request->all(), 'email')) {
            $validator = Validator::make($request->all(),[
                'email' => 'required|string|email|max:255|unique:users'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $administrator->user()
                ->update(['email' => Arr::get($request->all(), 'email')]);
        }
        if (Arr::exists($request->all(), 'password')) {
            $validator = Validator::make($request->all(),[
                'password' => 'required|string|min:8'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
                $administrator->user()
                ->update(['password' => Hash::make(Arr::get($request->all(), 'password'))]);
        }
        return json_encode('Dados alterados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy($administrator)
    {
        $administrator = Administrator::find($administrator);
        if (is_null($administrator)) {
            return json_encode('Administrador não existe!');
        }
        $user_id = $administrator->user_id;
        $user = User::find($user_id);
        $user->delete();
        $administrator->delete();
        return json_encode('Administrador apagado!');
    }

}
