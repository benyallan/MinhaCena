<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Administrator as AdministratorResource;
use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Administrator::all();
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
        $user = new User();
        $dados['user_type'] = 'Administrator';
        $user = $user->create($dados);
        $dados['user_id'] = $user->id;
        $administrator = Administrator::create($dados);
        return new AdministratorResource($administrator);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator)
    {
        $administrator = Administrator::find($administrator);
        if (is_null($administrator)) {
            return json_encode('Administrador não existe!');
        }
        return $administrator;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrator $administrator)
    {
        $administrator = Administrator::find($administrator);
        if (is_null($administrator)) {
            return json_encode('Adminstrador não existe!');
        }
        $administrator->update($request->all());
        return $administrator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        $administrator = Administrator::find($administrator);
        if (is_null($administrator)) {
            return json_encode('Administrador não existe!');
        }
        $administrator->delete();
        return json_encode('Administrador apagado!');
    }


}
