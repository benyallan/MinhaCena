<?php

namespace App\Http\Controllers;


use App\Models\Redaction;
use Illuminate\Http\Request;
use App\Http\Resources\Redaction as RedactionResource;

class RedactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RedactionResource::collection(Redaction::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $redaction = Redaction::creaate($request->all());
        return new RedactionResource($redaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redaction  $redaction
     * @return \Illuminate\Http\Response
     */
    public function show($redaction)
    {
        $redaction = Redaction::find($redaction);
        if (is_null($redaction)) {
            return json_encode('Redação não encontrada!');
        }
        return new RedactionResource($redaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redaction  $redaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $redaction)
    {
        $redaction = Redaction::find($redaction);
        if (is_null($redaction)) {
            return json_encode('Redação não encontrada!');
        }
        $redaction->update($request->all());
        return new RedactionResource($redaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redaction  $redaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($redaction)
    {
        $redaction = Redaction::find($redaction);
        if (is_null($redaction)) {
            return json_encode('Redação não encontrada!');
        }
        $redaction->delete();
        return json_encode('Redação apagada!');
    }
}
