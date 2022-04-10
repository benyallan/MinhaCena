<?php

namespace App\Http\Controllers;

use App\Models\Illustrator;
use App\Http\Resources\Illustrator as IllustratorResource;
use App\Http\Resources\SocialMedias as SocialMediasResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IllustratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IllustratorResource::collection(Illustrator::all());
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
        $user = User::create($dados);
        $dados['user_id'] = $user->id;
        $user->user_type = 'Illustrator';
        $illustrator = Illustrator::create($dados);
        $illustrator->save();
        return new IllustratorResource($illustrator);
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
        return new IllustratorResource($illustrator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $illustrator)
    {
        $illustrator = Illustrator::find($illustrator);
        if (is_null($illustrator)) {
            return json_encode('Ilustrador não existe!');
        }
        $illustrator->update($request->all());
        if (Arr::exists($request->all(), 'email')) {
            $illustrator->user()
                ->update(['email' => Arr::get($request->all(), 'email')]);
        }
        if (Arr::exists($request->all(), 'password')) {
            $illustrator->user()
            ->update(['password' => Arr::get($request->all(), 'password')]);
        }
        return new IllustratorResource($illustrator);
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
        return SocialMediasResource::collection($illustrator->socialMedias);
    }


}
