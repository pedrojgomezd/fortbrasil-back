<?php

namespace Tests\Feature;

use App\Http\Resources\Establishments;
use App\Models\Address;
use App\Models\Establishment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EstablishmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_establishment()
    {
        $this->singInApi();

        $data = [
            'cnpj' => '98239483891234',
            'razon_social' => 'Nome do empresa',
            "address" => [
                'cep' => '95082-380',
                'logradouro' => 'Avenida Independência',
                'complemento' => '1358',
                'bairro' => 'Cristo Redentor',
                'localidade' => 'Caxias do Sul',
                'uf' => 'RS',
            ]
        ];

        $response = $this->postJson('api/establishments', $data);

        $response->assertCreated();

        $response->assertJson($data);
    }

    public function test_a_user_can_see_list_establishment()
    {
        $this->singInApi();

        $establishments = Establishment::factory()
            ->count(10)
            ->create();
        $establishments->map(
            fn ($establishment) =>
            Address::factory()->create(['establishment_id' => $establishment->id])
        );

        $response = $this->getJson('api/establishments');

        $resource = Establishments::collection($establishments->load('address'))
            ->response()
            ->getData(true);

        $response->assertSuccessful();

        $response->assertJson($resource);
    }

    public function test_a_user_can_see_details_establishment()
    {
        $this->singInApi();

        $establishment = Establishment::factory()->create();

        Address::factory()->create(['establishment_id' => $establishment->id]);

        $resource = Establishments::make($establishment)->response()->getData(true);

        $response = $this->getJson("api/establishments/$establishment->id");

        $response->assertSuccessful();

        $response->assertJson($resource);
    }

    public function test_a_user_can_update_info_of_establishment()
    {
        $this->singInApi();

        $establishment = Establishment::factory()->create();
        Address::factory()->create(['establishment_id' => $establishment->id]);

        $data = [
            'cnpj' => '28392829304928',
            'razon_social' => 'Pedro Doe',
            "address" => [
                'cep' => '95082-380',
                'logradouro' => 'Avenida Independência',
                'complemento' => '1358',
                'bairro' => 'Cristo Redentor',
                'localidade' => 'Caxias do Sul',
                'uf' => 'RS',
            ]
        ];

        $response = $this->putJson("api/establishments/$establishment->id", $data);

        $response->assertStatus(201);

        $response->assertJson($data);
    }

    public function test_a_user_can_remove_a_establishment()
    {
        $this->singInApi();

        $establishment = Establishment::factory()->create();

        $response = $this->deleteJson("api/establishments/$establishment->id");

        $response->assertStatus(204);
    }
}
