<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_addresses_database_has_extected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('addresses', [
                'id', 'cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf', 'establishment_id'
            ]),
            1
        );
    }
}
