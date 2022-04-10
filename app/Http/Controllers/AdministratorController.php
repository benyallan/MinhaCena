<?php

namespace App\Http\Controllers;

use App\Http\Resources\Administrator as AdministratorResource;
use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdministratorController extends Controller
{
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
        $dados = $request->all();
        $administrator = Administrator::create($dados);
        $user = User::create($dados);
        $user->user_type = 'Administrator';
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
            $administrator->user()
                ->update(['email' => Arr::get($request->all(), 'email')]);
        }
        if (Arr::exists($request->all(), 'password')) {
            $administrator->user()
            ->update(['password' => Arr::get($request->all(), 'password')]);
        }
        return new AdministratorResource($administrator);
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
        $administrator->delete();
        return json_encode('Administrador apagado!');
    }


}
