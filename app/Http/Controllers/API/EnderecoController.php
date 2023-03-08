<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class EnderecoController extends Controller
{
    public function getAll()
    {
        try {
            $data = Endereco::all();
            return response()->json($data, 200);
        }catch (Exception $exception) {
            return [
                'status' => 500,
                'source' => ['pointer' => \url()->current() ],
                'title'  => 'Erro interno de servidor',
                'details' => 'Não foi possivel carregar a listagem dos endereços',
                "timestamp" => date('d/m/Y H:i:s')
            ];
        }
    }

    public function create(Request $request){
        $data['logradouro'] = $request['logradouro'];
        $data['cidade'] = $request['cidade'];
        $data['estado'] = $request['estado'];
        $data['tipo'] = $request['tipo'];

        Endereco::create($data);

        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
      }

      public function delete($id){
        $res = Endereco::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
      }

      public function get($id, Request $request){
          try {
              $data = Endereco::find($id);
              return response()->json($data, 200);
          }catch (ModelNotFoundException $exception) {
              return response()->json([
                  'status' => 404,
                  'source' => ['pointer' => $request->url() ],
                  'title'  => 'Endereço não encontrado',
                  'details' => 'O endereço #' .$id. 'não foi encontrado',
                  "timestamp" => date('d/m/Y H:i:s')
              ]);
          }
      }

      public function update(Request $request,$id){
        $data['logradouro'] = $request['logradouro'];
        $data['cidade'] = $request['cidade'];
        $data['estado'] = $request['estado'];
        $data['tipo'] = $request['tipo'];
        Endereco::find($id)->update($data);
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
      }
}
