<?php

namespace App\Http\Controllers;

class MensagemController extends Controller
{
    public function reiniciarSolicitacaoFerias($id)
    {
        return response()->json([
            'success' => true,
            'id' => $id,
            'message' => 'A solicitação de ferias foi Reiniciada!!'
        ]);
    }

    public function erroCriarSolicitacaoFerias($id)
    {
        return response()->json([
            'success' => false,
            'id' => $id,
            'message' => 'Erro ao criar a solicitação de férias!'
        ]);
    }

    public function solicitacaoFeriasRejeitada($id)
    {
        return response()->json([
            'success' => true,
            'id' => $id,
            'message' => 'Solicitação de Rejeitada!'
        ]);
    }

    public function solicitacaoFeriasNaoEncontrada($id)
    {
        return response()->json([
            'success' => false,
            'id' => $id,
            'message' => 'Solicitação de Férias não encotrada!'
        ]);
    }

    public function solicitacaoFeriasAprovada()
    {
        return response()->json([
            'message' => 'Aprovação realizada com sucesso.',
            'success' => true
        ]);
    }

    public function enviarFeriasDRH($id)
    {
        return response()->json([
            'success' => true,
            'id' => $id,
            'message' => 'A sua solicitação de férias foi enviada para o DRH'
        ]);
    }

    public function aprovacaoPendente($id)
    {
        return response()->json([
            'success' => false,
            'id' => $id,
            'message' => 'É necessário selecionar um aprovador para todas as solicitações!'
        ]);
    }

    public function ExisteAprovador($id)
    {
        return response()->json([
            'success' => false,
            'id' => $id,
            'message' => 'Este aprovador já foi selecionado para esta solicitação de férias.'
        ]);
    }

    public function sucessoStore($id)
    {
        return response()->json([
            'message' => 'Registro criado com sucesso',
            'id' => $id,
            'success' => true
        ]);
    }

    public function erroStore($mensagem)
    {
        return response()->json([
            'message' => $mensagem,
            'success' => false
        ]);
    }


    public function sucessoIniciarAtividade($id)
    {
        return response()->json([
            'message' => 'Registro criado com sucesso',
            'pgd_id' => $id,
            'success' => true
        ]);
    }
    public function sucessoAtivarAtividade($id)
    {
        return response()->json([
            'message' => 'Registro Ativado com sucesso',
            'pgd_id' => $id,
            'success' => true
        ]);
    }

    public function sucessoPausarAtividade($id)
    {
        return response()->json([
            'message' => 'Registro criado com sucesso',
            'pgd_id' => $id,
            'success' => true
        ]);
    }
    public function sucessoEditarConclusaoAtividade($id)
    {
        return response()->json([
            'message' => 'Registro criado com sucesso',
            'pgd_id' => $id,
            'success' => true
        ]);
    }
    public function pgdSuspenso($numero_pgd)
    {
        return response()->json([
            'message' => 'Plano de Trabalho suspenso!',
            'numero_pgd' => $numero_pgd,
            'success' => false
        ]);
    }

    public function erroAtividade($id)
    {
        return response()->json([
            'message' => 'Atividade n° ' . $id . ' não encontrada!',
            'atividade_id' => $id,
            'success' => false,
        ]);
    }
    public function erroArquivo()
    {
        return response()->json([
            'message' => 'Erro ao salvar o arquivo!',
            'success' => true
        ]);
    }

    public function sucessoStoreFuncionario($id, $telefone, $nome)
    {
        return response()->json([
            'message' => 'Registro criado com sucesso',
            'id' => $id,
            'success' => true,
            'telefone' => $telefone,
            'nome' => $nome,
        ]);
    }

    public function sucessoUpdate($user_id = null)
    {
        return response()->json([
            'message' => 'Registro editado com sucesso.',
            'success' => true,
            'email' => $user_id
                ? 'E-mail de confirmação enviado para o(a) usuário(a).'
                : 'E-mail de confirmação não enviado. Atualize o e-mail funcional do(a) usuário(a).',

        ]);
    }

    public function sucessoDestroy()
    {
        return response()->json([
            'message' => 'Registro excluido com sucesso.',
            'success' => true
        ]);
    }

    public function errorDestroy($id)
    {
        return response()->json([
            'message' => 'Ocorreu um erro na exclusão do registro',
            'id' => $id,
            'success' => false
        ]);
    }

    public function naoLocalizado()
    {
        return response()->json([
            'message' => 'Registro não encontrado no banco.',
            'success' => false
        ]);
    }

    public function convenioVencido()
    {
        return response()->json([
            'message' => 'Convênio indisponível. Verifique mais detalhes no DRH.',
            'success' => false
        ]);
    }
    public function convenioJaCadastrado()
    {
        return response()->json([
            'message' => 'Dependente já possui convênio ativo.',
            'success' => false
        ]);
    }

    public function mensagemErro($mensagem)
    {
        $msg = $mensagem;
        if ($mensagem instanceof \Exception || $mensagem instanceof \Throwable) {
            $msg = $mensagem->getMessage();
        }

        return response()->json([
            'success' => false,
            'message' => $msg,
        ]);
    }

    public function existeFerias()
    {
        return response()->json([
            'message' => 'Você já possui uma solicitação de férias em andamento ou aprovada neste ano. Não é possível abrir outra.',
            'success' => false
        ]);
    }

    public function mensagemErroDependente()
    {
        return response()->json([
            'message' => "O CPF cadastrado pertence a outro dependente cadastrado",
            'success' => false
        ]);
    }
    public function mensagemErroMatricula($matricula, $pessoa)
    {
        return response()->json([
            'message' => "A matricula nº $matricula está vinculada ao cadastro de $pessoa",
            'success' => false
        ]);
    }

    public function mensagemDeleteErro()
    {
        return response()->json([
            'message' => 'O registro não pode ser excluído. Entre em contato com a DTI.',
            'success' => false
        ]);
    }

    public function sucessoAprovacaoWf()
    {
        return response()->json([
            'message' => 'Aprovação realizada com sucesso.',
            'success' => true
        ]);
    }

    public function sucessoRejeicaoWf()
    {
        return response()->json([
            'message' => 'Rejeição realizada com sucesso.',
            'success' => true
        ]);
    }
    public function sucessReabrirWf()
    {
        return response()->json([
            'message' => 'Reaberto com sucesso.',
            'success' => true
        ]);
    }
    public function avaliacaoPNR($id)
    {
        return response()->json([
            'message' => $id,
            'success' => false
        ]);
    }
    public function mensagemDeleteWorkflow()
    {
        return response()->json([
            'message' => 'Não é possível excluir o registro, pois o workflow já foi iniciado.',
            'success' => false
        ]);
    }
    public function finalizarAutoAprovacao()
    {
        return response()->json([
            'message' => 'Autoavaliação finalizada com sucesso.',
            'success' => true
        ]);
    }
    public function assinado()
    {
        return response()->json([
            'message' => 'Documento assinado com sucesso!.',
            'success' => true
        ]);
    }
    public function ErroAssinatura()
    {
        return response()->json([
            'message' => 'Erro ao assinar documento!.',
            'success' => true
        ]);
    }
    public function envAssinatura()
    {
        return response()->json([
            'message' => 'PMI enviado para assinatura do Chefe!.',
            'success' => true
        ]);
    }
    public function cpfJaCadastrado()
    {
        return response()->json([
            'message' => 'Já existe um usuário com esse CPF.',
            'success' => false
        ]);
    }

    private function mensagemErroValidacao($mensagem, $pessoa_id = null)
    {
        $response = ['error' => $mensagem];
        if ($pessoa_id) {
            $response['pessoa_id'] = $pessoa_id;
        }
        return response()->json($response, 422);
    }

    public function estoqueInsuficiente($quantidade)
    {
        return response()->json([
            'message' => 'Estoque insuficiente para a saída. Estoque atual: '.abs($quantidade),
            'success' => false
        ]);
    }
      public function relacionamento($tabela)
    {
        return response()->json([
            'message' => 'Registro possui Relacionamento no cadastro de '.$tabela.'.',
            'success' => false
        ]);
    }
}