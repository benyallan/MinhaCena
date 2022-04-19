<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministrationRequest;
use App\Http\Resources\Illustrator as IllustratorResources;
use App\Http\Resources\School as SchoolResources;
use App\Models\Illustrator;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(AdministrationRequest $request)
    {
        $modelUser = $this->toModel(
                Arr::get($request->only(['id']), 'id'),
                Arr::get($request->only(['authenticUser']), 'authenticUser')
            );
        $model = $modelUser['model'];
        if ($model->user) {
            return response()->json('Já há credenciais para esse usuário');
        }
        $credenciais = $request->only(['email', 'password']);
        $credenciais['password'] = Hash::make($credenciais['password']);
        $user = User::create($credenciais);
        $user->update([
                'data_id' => $modelUser['id'],
                'data_type' => $modelUser['type']
            ]);
        $user->data->update(['user_id' => $user->id]);
        return $this->toResourceModel($user->data);
    }

    private function toModel(int $id, String $modelUser)
    {
        switch ($modelUser) {
            case 'Ilustrador':
                $illustrator = Illustrator::find($id);
                return [
                        'model' => $illustrator,
                        'id' => $illustrator->id,
                        'type' => Illustrator::class
                    ];
                break;
            case 'Escola':
                $school = School::find($id);
                return [
                        'model' => $school,
                        'id' => $school->id,
                        'type' => School::class
                    ];
                break;

            default:
                return null;
                break;
        }
    }


    private function toResourceModel(Model $modelUser)
    {
        switch (class_basename($modelUser)) {
            case 'Illustrator':
                return new IllustratorResources($modelUser);
                break;
            case 'School':
                return new SchoolResources($modelUser);
                break;

            default:
                return null;
                break;
        }
    }
}
