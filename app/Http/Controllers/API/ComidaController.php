<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comida;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ComidaController extends Controller
{


    public function create(Request $request)
    {
        try {
            Comida::create([
                'descricao' => $request['descricao'],
                'tipo' => $request['tipo'],
                'preco' => $request['preco'],
                'saudavel' => $request['saudavel']
            ]);

            return response()->json([
                'message' => 'Comida cadastrada com sucesso',
                'success' => true
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'source' => $request->url(),
                'title' => 'Registro não cadastrado',
                'details' => 'Não foi possivel cadastrar a comida, verifique os dados',
                'timestamp' => date('d/m/Y H:i:s'),
            ]);
        }

    }

    public function getAll(Request $request)
    {
        try {
            $data = Comida::orderBy('descricao', 'asc')->get();
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

    public function update(Request $request)
    {
        try {
            Comida::findOrFail($request->id)->update([
                'tipo' => $request['tipo'],
                'descricao' => $request['descricao'],
                'preco' => $request['preco'],
                'saudavel' => $request['saudavel']
            ]);

            return response()->json([
                'message' => 'Comida atualizada com sucesso',
                'success' => true
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'source' => $request->url(),
                'title' => 'Registro não cadastrado',
                'details' => 'Não foi possivel cadastrar a comida, verifique os dados',
                'timestamp' => date('d/m/Y H:i:s'),
            ]);
        }

    }

    public function delete(Request $request)
    {
        try {
            Comida::findOrfail($request->id)->delete();

            return response()->json([
                'message' => 'Comida deletada com sucesso',
                'sucess' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "source" => ["pointer" => $request->url()],
                "title" => "Registro não encontrado",
                "detail" => "Comida #" . $request->id . " não foi encontrada",
                "timestamp" => date('d/m/Y H:i:s')
            ], 500);
        }

    }

    public function get(Request $request)
    {
        try {
            $data = Comida::findOrfail($request->id);
            return response()->json($data, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => 500,
                "source" => ["pointer" => $request->url()],
                "title" => "Registro não encontrado",
                "detail" => "Não encontramos a comida de #id" . $request->id,
                "timestamp" => date('d/m/Y H:i:s')
            ], 500);
        }
    }


}
