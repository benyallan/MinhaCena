<?php

namespace App\Http\Controllers;

use App\Models\Illustrator;
use App\Http\Resources\Illustrator as IllustratorResource;
use App\Http\Resources\SocialMedias as SocialMediasResource;
use App\Http\Resources\Redaction as ResourceRedaction;
use App\Models\Redaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'user_type' => 'Illustrator',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $dados = $request->all();
        $illustrator = Illustrator::create($dados);
        $illustrator->user_id = $user->id;
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
            $validator = Validator::make($request->all(),[
                'email' => 'required|string|email|max:255|unique:users'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $illustrator->user()
                ->update(['email' => Arr::get($request->all(), 'email')]);
        }
        if (Arr::exists($request->all(), 'password')) {
            $validator = Validator::make($request->all(),[
                'password' => 'required|string|min:8'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
                $illustrator->user()
                ->update(['password' => Hash::make(Arr::get($request->all(), 'password'))]);
        }
        return json_encode('Dados alterados!');
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
        $user_id = $illustrator->user_id;
        $user = User::find($user_id);
        $user->delete();
        $illustrator->delete();
        return json_encode('Ilustrador apagado!');
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

    /**
     * .
     *
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function assignRedaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'redaction_id' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $redaction = Redaction::find($request->redaction_id);
        if (is_null($redaction)) {
            return json_encode('Redação não existe!');
        }
        $redaction->illustrators()->attach($request->user()->thisUser());
        return new ResourceRedaction($redaction);
    }

    /**
     * .
     *
     * @param  \App\Models\Illustrator  $illustrator
     * @return \Illuminate\Http\Response
     */
    public function unassignRedaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'redaction_id' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $redaction = Redaction::find($request->redaction_id);
        if (is_null($redaction)) {
            return json_encode('Redação não existe!');
        }
        $redaction->illustrators()->dettach($request->user()->thisUser());
        return new ResourceRedaction($redaction);
    }

    public function deliveryIllustration()
    {
        # code...
    }
}
