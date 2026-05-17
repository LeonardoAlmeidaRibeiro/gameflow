<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuscleGroupValidator;
use App\Models\MuscleGroup;
use Exception;
use Illuminate\Http\Request;

class MuscleGroupController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $muscleGroups = MuscleGroup::all();

        return view('muscle-group.index', compact('user', 'muscleGroups'));
    }

    public function store(MuscleGroupValidator $request)
    {
        try {

            $mensagem = new MensagemController;
            $validator = $request->validated();

            $muscleGroup = MuscleGroup::create($validator);

            return $mensagem->sucessoStore($muscleGroup->id);

        } catch (Exception $e) {

            return $mensagem->mensagemErro($e->getMessage());
        }
    }

    public function destroy($id, Request $request)
    {
        try {

            $mensagem = new MensagemController;
            $muscleGroup = MuscleGroup::find($id);

            if ($muscleGroup) {
                $muscleGroup->delete();

                return $mensagem->sucessoDestroy();
            } else {
                return $mensagem->naoLocalizado();
            }

        } catch (Exception $e) {

            return $mensagem->mensagemErro($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $mensagem = new MensagemController;
            $muscleGroup = MuscleGroup::find($id);

            if ($muscleGroup) {

                $data = [
                    'nome' => $request->nome,
                ];

                $muscleGroup->update($data);

                return $mensagem->sucessoUpdate();

            } else {
                return $mensagem->naoLocalizado();
            }

        } catch (Exception $e) {

            return $mensagem->mensagemErro($e->getMessage());
        }
    }
}