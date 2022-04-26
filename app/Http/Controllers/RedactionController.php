<?php

namespace App\Http\Controllers;


use App\Models\Redaction;
use App\Http\Resources\Redaction as RedactionResource;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redaction  $redaction
     * @return \Illuminate\Http\Response
     */
    public function show(Redaction $redaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redaction  $redaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redaction $redaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redaction  $redaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redaction $redaction)
    {
        //
    }
}
