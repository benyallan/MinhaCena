<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\Request;

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
        return new TagResource(Tag::create($request->all()));
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
        return new TagResource($tag);
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
        $tag->update($request->all());
        return new TagResource($tag);
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
