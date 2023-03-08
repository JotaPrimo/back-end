<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetResource;
use App\Models\API\PetsEstimacao;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PetsEstimacaoController extends Controller
{
    public function create(Request $request)
    {
        try {
            PetsEstimacao::create([
                'nome' => $request['nome'],
                'especie' => $request['especie'],
                'peso' => $request['peso'],
                'pelagem' => $request['pelagem'],
                'sexo' => $request['sexo']
            ]);

            return response()->json([
                'message' => 'Pet cadastrado com sucesso',
                'success' => true
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 400,
                "source" => ["pointer" => $request->url()],
                'title' => "Registro não cadastrado",
                'details' => 'Não foi possivel cadastrar esse pet, verifique seus dados',
                'timestamp' => date('d/m/Y H:i:s'),
            ]);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $data = PetsEstimacao::orderBy('nome')->get();
            return response()->json(PetResource::collection($data), 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                "source" => ["pointer" => $request->url()],
                'title' => "Listagem não carregada",
                'details' => "Não foi possivel carregar a listagem dos pets. Erro interno de servidor",
                "timestamp" => date('d/m/Y H:i:s')
            ], 500);
        }
    }

    public function get(Request $request)
    {
        try {
            $data = PetsEstimacao::findOrfail($request->id);
            return response()->json($data, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => 500,
                "source" => ["pointer" => $request->url()],
                "title" => "Registro não encontrado",
                "detail" => "Não encontramos o pet de #id" . $request->id,
                "timestamp" => date('d/m/Y H:i:s')
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            PetsEstimacao::findOrFail($request->id)->update([
                'nome' => $request['nome'],
                'especie' => $request['especie'],
                'peso' => $request['peso'],
                'pelagem' => $request['pelagem'],
                'sexo' => $request['sexo']
            ]);

            return response()->json([
                'message' => "O pet # " . $request->id . " foi atualizado com sucesso",
                'success' => true
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                "source" => ["pointer" => $request->url()],
                'title' => "Registro não encontrado",
                'details' => "O registro #" . $request->id . " não foi localizado",
                'timestamp' => date('d/m/Y H:i:s'),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            PetsEstimacao::findOrfail($request->id)->delete();

            return response()->json([
                'message' => 'Pet deletado com sucesso',
                'sucess' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "source" => ["pointer" => $request->url()],
                "title" => "Registro não encontrado",
                "detail" => "pet #" . $request->id . " não foi encontrada",
                "timestamp" => date('d/m/Y H:i:s')
            ], 500);
        }
    }

}
