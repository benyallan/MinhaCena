<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Http\Resources\Log as LogResource;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LogResource::collection(Log::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $log = Log::create($request->all());
        return new LogResource($log);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show($log)
    {
        $log = Log::find($log);
        if (is_null($log)) {
            return json_encode('Log não existe!');
        }
        return $log;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $log)
    {
        $log = Log::find($log);
        if (is_null($log)) {
            return json_encode('Log não existe!');
        }
        $log->update($request->all());
        return json_encode('Dados alterados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy($log)
    {
        $log = Log::find($log);
        if (is_null($log)) {
            return json_encode('Log não existe!');
        }
        $log->delete();
        return json_encode('Log apagado!');
    }
}
