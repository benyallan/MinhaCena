<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Redaction as RedactionResource;
use App\Models\IllustratorRedaction;
use App\Models\Redaction;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $redaction = Redaction::first();
        foreach ($redaction->illustrators as $illustrator) {
            $retorno[] = $illustrator;
        }
        $retorno[0]->pivot->illustration = 'teste';
        return $retorno[0]->pivot;
        */

        //return IllustratorRedaction::where(['redaction_id' => 1])->get();
        return new RedactionResource(Redaction::first());
        return UserResource::collection(User::all());
    }



}
