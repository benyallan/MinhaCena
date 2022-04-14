<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\School as SchoolResources;
use App\Models\Illustrator;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $credenciais = $request->only(['email', 'password']);
        $credenciais['password'] = Hash::make($credenciais['password']);
        $user = User::create($credenciais);
        $model = Arr::get($request->only(['model']), 'model');
        $id = Arr::get($request->only(['id']), 'id');
        $user->update([
                'data_id' => $id,
                'data_type' => $this->toModel($model)
            ]);
        $school = $user->data;
        return new SchoolResources($school);
    }

    private function toModel(String $model)
    {
        switch ($model) {
            case 'Ilustrador':
                return Illustrator::class;
                break;
            case 'Escola':
                return School::class;
                break;

            default:
                return null;
                break;
        }
    }
}
