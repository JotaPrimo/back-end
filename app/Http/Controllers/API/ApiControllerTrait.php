<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

trait ApiControllerTrait
{
    public function getAll(Request $request)
    {
        try {
            $limit = $request->limit ?? 15;
            $order = $request->order ?? null;

            if($order !== null) {
                $order = explode(',', $order);
            }

            $order[0] = $order[0] ?? 'id';
            $order[1] = $order[1] ?? 'asc';

            $data = $this->model->orderBy($order[0], $order[1])->paginate($limit);
            return response()->json([
                $data, 200
            ]);

        } catch (\Exception $th) {
            return response()->json([
                "status" => 500,
                "source" => [ "pointer" => $request->url() ],
                "title" => "Listagem não carregada",
                "detail" => "Não foi possivel carregar a listagem de comidas.",
                "timestamp" => date('d/m/Y H:i:s')
            ]);
        }
    }

    public function get(int $id, Request $request)
    {
        try {
            $data = $this->model->findOrFail($id);
            return response()->json([
                $data,
                200
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                "status" => 500,
                "source" => [ "pointer" => $request->url() ],
                "title" => "Registro não encontrado",
                "detail" => "Não foi possivel carregar o registro #" .$id,
                "timestamp" => date('d/m/Y H:i:s')
            ]);
        }
    }

    public function create(Request $request)
    {
    	try {
    		$this->model->create([
    			'descricao' => $request->descricao,
                'tipo' => $request->tipo,
                'preco' => $request->preco,
                'saudavel' => $request->saudavel
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
        $this->model->findOrfail($id)->delete();
        return response()->json([
          "message" => "Comida deletado com succeso",
          "success" => true
        ], 200);
      } catch (\Exception $e) {

        return response()->json([
          "status" => 400,
          "type" => $request->url(),
          "detail" => "Comida não encontrado. Por isso não foi deletado com sucesso",
          "timestamp" => date('d/m/Y H:i:s.u')
        ], 400);
      }

    }

    public function update(Request $request, int $id){

      try {
        $comida = $this->model->findOrfail($id);
        return $request->descricao;

        $comida->update($request->all());

        return response()->json([
            'message' => "Dados atualizados com sucesso",
            'success' => true
        ], 200);

      } catch (\Exception $e) {

        return response()->json([
    			"status" => 400,
    			"type" => $request->url(),
                "detail" => "Erro ao tentar atualizar o registro #".$id.". Verifique as informaçãos"
    		], 400);
      }

    }
}
