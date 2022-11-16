<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function getAll()
    {
        $data = Endereco::all();
        return response()->json($data, 200);
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

      public function get($id){
        $data = Endereco::find($id);
        return response()->json($data, 200);
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
