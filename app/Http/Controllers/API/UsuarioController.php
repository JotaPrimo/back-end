<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function getAll()
    {
        $data = User::orderBy('name')->get();

        return response()->json($data, 200);
    }

    public function create(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'tipo_user' => $request->tipo_user,
                'password' => Hash::make($request->password)
                ]
            );

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Ocorreu um erro. Nâo foi possivel salvar',
                'success' => false
            ]);
        }
    }

    public function get(int $id)
    {
        try {
            $data = User::findOrFail($id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Usuário não encontrado',
                'success' => false
            ]);
        }
    }

    public function delete($id){
        $res = User::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
      }

    public function update(Request $request, $id){

        try {
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            return response()->json([
                'message' => "Successfully updated",
                'success' => true
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Error updated",
                'success' => false
            ], 200);
        }


      }
}
