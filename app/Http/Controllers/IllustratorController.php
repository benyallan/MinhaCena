<?php

namespace App\Http\Controllers;

use App\Models\Illustrator;
use Illuminate\Http\Request;

class IllustratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Illustrator::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Illustrator::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function show($illustrator)
    {
        $illustrator = Illustrator::find($illustrator);
        if (is_null($illustrator)) {
            return json_encode('Ilustrador não existe!');
        }
        return $illustrator;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Illustrator $illustrator)
    {
        $illustrator = Illustrator::find($illustrator);
        if (is_null($illustrator)) {
            return json_encode('Ilustrador não existe!');
        }
        $illustrator->update($request->all());
        return $illustrator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function destroy($illustrator)
    {
        $illustrator = Illustrator::find($illustrator);
        if (is_null($illustrator)) {
            return json_encode('Ilustrador não existe!');
        }
        $illustrator->delete();
        return json_encode('Ilustador apagado!');
    }

    /**
     * .
     *
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function socialMedias($illustrator)
    {
        $illustrator = Illustrator::find($illustrator);
        if (is_null($illustrator)) {
            return json_encode('Ilustrador não existe!');
        }
        return $illustrator->socialMedias;
    }


}
