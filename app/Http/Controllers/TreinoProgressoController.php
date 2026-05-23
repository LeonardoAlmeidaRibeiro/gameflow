<?php

namespace App\Http\Controllers;

use App\Http\Requests\TreinoProgressoValidator;
use App\Models\WorkoutProgress;
use Exception;
use Illuminate\Http\Request;

class TreinoProgressoController extends Controller
{
    public function store(TreinoProgressoValidator $request)
    {

        try {

            $mensagem   = new MensagemController;
            $validator  = $request->validated();
            $categoria     = WorkoutProgress::create($validator);

            return $mensagem->sucessoStore($categoria->id);
        } catch (Exception $e) {

            return $mensagem->mensagemErro($e->getMessage());
        }
    }


    public function destroy($id)
    {

        try {

            $mensagem   = new MensagemController;
            $categoria      = WorkoutProgress::find($id);

            if ($categoria) {
                $categoria->delete();

                return $mensagem->sucessoDestroy();
            } else {
                return $mensagem->naoLocalizado();
            }
        } catch (Exception $e) {


            return $mensagem->mensagemErro($e->getMessage());
        }
    }

    function update(TreinoProgressoValidator $request, $id)
    {

        try {

            $mensagem   = new MensagemController;
            $validator  = $request->validated();
            $categoria      = WorkoutProgress::find($id);

            if ($categoria) {
                $categoria->update($validator);

                return $mensagem->sucessoUpdate($categoria->id);
            } else {
                return $mensagem->naoLocalizado();
            }
        } catch (Exception $e) {

            return $mensagem->mensagemErro($e->getMessage());
        }
    }
}
