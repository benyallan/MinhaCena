<?php

namespace App\Http\Controllers;

use App\Models\Illustrator;
use App\Models\SocialMedia;
use App\Http\Resources\SocialMedias as SocialMediasResource;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SocialMediasResource::collection(SocialMedia::all());
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
        $illustrator = Illustrator::find($dados['illustrator_id']);
        if (is_null($illustrator)) {
            return json_encode('Ilustrador não encontrado!');
        }
        $socialMedia = new SocialMedia($request->all());
        $illustrator->socialMedias()->save($socialMedia);
        return new SocialMediasResource($socialMedia);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function show($socialMedia)
    {
        $socialMedia = SocialMedia::find($socialMedia);
        if (is_null($socialMedia)) {
            return json_encode('Mídia Social não existe!');
        }
        return new SocialMediasResource($socialMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $socialMedia)
    {
        $socialMedia = SocialMedia::find($socialMedia);
        if (is_null($socialMedia)) {
            return json_encode('Mídia Social não existe!');
        }
        $dados = $request->all();
        $socialMedia->update($dados);
        return json_encode('Dados alterados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($socialMedia)
    {
        $socialMedia = SocialMedia::find($socialMedia);
        if (is_null($socialMedia)) {
            return json_encode('Mídia Social não existe!');
        }
        $socialMedia->delete();
        return json_encode('Mídia Social apagada!');
    }
}
