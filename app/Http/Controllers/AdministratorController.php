<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
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
        return Administrator::create($request->all());
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
