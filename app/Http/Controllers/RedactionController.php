<?php

namespace App\Http\Controllers;


use App\Models\Redaction;
use App\Http\Resources\Redaction as RedactionResource;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        //dd($request->user()->thisUser()->first()->id);
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'student' => 'required',
            'composing' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $tags = $request->tags;
        $tags = explode(',', $tags);
        $dados = $request->all();
        $dados['teacher_id'] = $request->user()->thisUser();
        $redaction = Redaction::create($dados);
        $redaction->tags()->sync($tags);
        return new RedactionResource($redaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redaction  $redaction
     * @return \Illuminate\Http\Response
     */
    public function show(Redaction $redaction)
    {
        $school = Redaction::find($redaction);
        if (is_null($redaction)) {
            return json_encode('Redação não existe!');
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
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'student' => 'required',
            'composing' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $tags = $request->tags;
        $tags = explode(',', $tags);
        $dados = $request->all();
        //$dados['teacher_id'] = $request->user()->thisUser()->first()->id;
        $redaction = Redaction::find($redaction);
        $redaction->update($dados);
        $redaction->tags()->sync($tags);
        return new RedactionResource($redaction);
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
