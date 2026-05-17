<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoriaValidator;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $categorias = Categoria::all();

        return view('categoria.index', compact('user', 'categorias'));
    }

    public function store(CategoriaValidator $request)
    {

        try {

            $mensagem   = new MensagemController;
            $validator  = $request->validated();
            $categoria     = Categoria::create($validator);
           
            return $mensagem->sucessoStore($categoria->id);
        } catch (Exception $e) {

            return $mensagem->mensagemErro($e->getMessage());
        }
    }

    public function destroy($id, Request $request)
    {

        try {

            $mensagem   = new MensagemController;
            $categoria      = Categoria::find($id);

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

    public function update(Request $request, $id)
    {

        try {

            $mensagem   = new MensagemController;
            $categoria      = Categoria::find($id);

            if ($categoria) {
                $data = [
                    'nome' => $request->nome,
                    'icone' => $request->icone,
                ];
                $dados = implode(" ", $data);
                $categoria->update($data);

                return $mensagem->sucessoUpdate();
            } else {
                return $mensagem->naoLocalizado();
            }
        } catch (Exception $e) {

            return $mensagem->mensagemErro($e->getMessage());
        }
    }
}
