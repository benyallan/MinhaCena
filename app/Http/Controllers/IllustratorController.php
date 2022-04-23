<?php

namespace App\Http\Controllers;

use App\Models\Illustrator;
use App\Http\Resources\Illustrator as IllustratorResource;
use App\Http\Resources\SocialMedias as SocialMediasResource;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class IllustratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->data) {
            Gate::authorize('viewAny', Illustrator::class);
        }

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
        $illustrator = Illustrator::create($request->all());
        return new IllustratorResource($illustrator);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $illustrator)
    {
        $illustrator = Illustrator::find($illustrator);
        if (is_null($illustrator)) {
            return json_encode('Ilustrador não existe!');
        }
        if ($request->user()->data) {
            Gate::authorize('view', $illustrator);
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
}
