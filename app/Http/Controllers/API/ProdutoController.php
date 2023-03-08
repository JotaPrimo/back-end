<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ProdutoController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $data = Produto::orderBy('titulo', 'asc')->get();
            return response()->json($data, 200);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "source" => ["pointer" => $request->url()],
                "title" => "Listagem não carregada",
                "detail" => "Não foi possivel carregar a listagem dos livros",
                "timestamp" => date('d/m/Y H:i:s')
            ], 500);
        }

    }

    public function get(Request $request, int $id)
    {
        try {
            $data = Produto::findOrfail($id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "422",
                "source" => ["pointer" => $request->url()],
                "title" => "Registro não encontrado",
                "detail" => "Não existe um livro cadastrado com esse id",
                "timestamp" => date('d/m/Y H:i:s.u')
            ], 400);
        }

    }

    public function create(Request $request)
    {
        try {
            Produto::create([
                'nome' => $request['nome'],
                'preco' => $request['preco'],
                'tipo' => $request['tipo'],
                'descricao' => $request['descricao'],
                'quantidade' => $request['quantidade'],
            ]);

            return response()->json([
                "message" => "Dados cadastrados com sucesso",
                "success" => true
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "status" => 400,
                "type" => $request->url(),
                "detail" => "Erro ao tentar cadastrar. Verifique as informaçãos"
            ], 400);
        }
    }

    public function delete(int $id, Request $request)
    {
        try {
            Produto::findOrfail($id)->delete();
            return response()->json([
                "message" => "Usuário deletado com succeso",
                "success" => true
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                "status" => 400,
                "type" => $request->url(),
                "detail" => "Produto não encontrado. Por isso não foi deletado com sucesso",
                "timestamp" => date('d/m/Y H:i:s.u')
            ], 400);
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $livro = Produto::findOrfail($id);

            $livro->update([
                'nome' => $request['nome'],
                'preco' => $request['preco'],
                'tipo' => $request['tipo'],
                'descricao' => $request['descricao'],
                'quantidade' => $request['quantidade'],
            ]);

            return response()->json([
                'message' => "Dados atualizados com sucesso",
                'success' => true
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                "status" => 400,
                "type" => $request->url(),
                "detail" => "Erro ao tentar atualizar o registro #" . $id . ". Verifique as informaçãos "
            ], 400);
        }

    }
}
