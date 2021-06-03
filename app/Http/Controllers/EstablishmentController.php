<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Establishments;
use Illuminate\Http\Resources\Json\JsonResource;

class EstablishmentController extends Controller
{

    public function index(Establishment $establishment): JsonResponse
    {
        return response()->json(
            Establishments::collection($establishment->all())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            "cnpj" => "required",
            "razon_social" => "required",
            "address.cep" => "required",
            "address.logradouro" => "required",
            "address.complemento" => "",
            "address.bairro" => "required",
            "address.localidade" => "required",
            "address.uf" => "required",
        ]);

        $establishment = Establishment::create($data);
        $establishment->address()->create($data['address']);

        return response()->json(
            Establishments::make($establishment),
            201
        );
    }

    public function show(Establishment $establishment): JsonResource
    {
        return Establishments::make($establishment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Establishment $establishment): JsonResponse
    {
        $data = $request->validate([
            "cnpj" => "required",
            "razon_social" => "required",
            "address.cep" => "required",
            "address.logradouro" => "required",
            "address.complemento" => "",
            "address.bairro" => "required",
            "address.localidade" => "required",
            "address.uf" => "required",
        ]);


        $establishment->update($data);
        $establishment->address()->update($data['address']);

        return response()->json(
            Establishments::make($establishment),
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establishment $establishment)
    {
        $establishment->delete();

        return response()->json([], 204);
    }
}
