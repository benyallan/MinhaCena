<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TagResource::collection(Tag::all());
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
            'tag' => 'required|unique:tags'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $tag = Tag::create($request->all());
        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        $tag = Tag::find($tag);
        if (is_null($tag)) {
            return json_encode('Tag não existe!');
        }
        return $tag;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tag)
    {
        $tag = Tag::find($tag);
        if (is_null($tag)) {
            return json_encode('Tag não existe!');
        }
        $validator = Validator::make($request->all(),[
            'tag' => 'required|unique:tags'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $tag->update($tag->all());
        return json_encode('Dados alterados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag)
    {
        $tag = Tag::find($tag);
        if (is_null($tag)) {
            return json_encode('Tag não existe!');
        }
        $tag->delete();
        return json_encode('Tag apagada!');
    }
}
