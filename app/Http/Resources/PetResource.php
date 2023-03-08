<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // camanada de tramento entre api e eloquent
        return [
            'id'    => $this->id,
            'nome'    => $this->nome,
            'especie' => $this->especie == 1 ? 'Cão' : 'Gato',
            'peso'    => $this->peso * 1000,
            'pelagem' => $this->pelagem,
            'sexo'    => $this->sexo == 1 ? 'Macho' : 'Femea'
        ];
    }
}
