<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Livro;
use Exception;

class LivroController extends Controller
{
    public function getAll(Request $request)
    {
    	try {
        $data = Livro::orderBy('titulo', 'asc')->get();
      	return response()->json($data, 200);

      } catch (\Exception $e) {
        return response()->json([
          "status" => 500,
          "source" => [ "pointer" => $request->url() ],
          "title" => "Listagem não carregada",
          "detail" => "Não foi possivel carregar a listagem dos livros",
          "timestamp" => date('d/m/Y H:i:s')
        ], 500);
      }

    }

    public function get(Request $request, int $id)
    {
      try {
        $data = Livro::findOrfail($id);
        return response()->json($data, 200);
      } catch (\Exception $e) {
        return response()->json([
          "status" => "422",
          "source" => [ "pointer" => $request->url() ],
          "title"  =>  "Registro não encontrado",
          "detail" => "Não existe um livro cadastrado com esse id",
            "timestamp" => date('d/m/Y H:i:s.u')
        ], 400);
      }

    }

    public function create(Request $request)
    {
    	try {
    		Livro::create([
    			'titulo' => $request['titulo'],
  				'autor'  => $request['autor'],
  				'isbn'   => $request['isbn'],
  				'qntd_exemplares' => $request['qntd_exemplares']
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

    public function delete(int $id)
    {
      try {
        Livro::findOrfail($id)->delete();
        return response()->json([
          "message" => "Usuário deletado com succeso",
          "success" => true
        ], 200);
      } catch (\Exception $e) {

        return response()->json([
          "status" => 400,
          "type" => $request->url(),
          "detail" => "Livro não encontrado. Por isso não foi deletado com sucesso",
          "timestamp" => date('d/m/Y H:i:s.u')
        ], 400);
      }

    }

    public function update(Request $request, int $id){

      try {
        $livro = Livro::findOrfail($id);

        $livro->update([
          'titulo' => $request['titulo'],
          'autor'  => $request['autor'],
          'isbn'   => $request['isbn'],
          'qntd_exemplares' => $request['qntd_exemplares']
        ]);

        return response()->json([
            'message' => "Dados atualizados com sucesso",
            'success' => true
        ], 200);

      } catch (\Exception $e) {

        return response()->json([
    			"status" => 400,
    			"type" => $request->url(),
          "detail" => "Erro ao tentar atualizar o registro #".$id.". Verifique as informaçãos "
    		], 400);
      }

    }

}
