<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Establishments extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "cnpj" => $this->cnpj,
            "razon_social" => $this->razon_social,
            "address" =>  [
                "cep" => $this->address->cep,
                "logradouro" => $this->address->logradouro,
                "complemento" =>  $this->address->complemento,
                "bairro" => $this->address->bairro,
                "localidade" => $this->address->localidade,
                "uf" => $this->address->uf,
            ]
        ];
    }
}
