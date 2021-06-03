<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EstablishmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_establishments_database_has_extected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('establishments', [
                'id', 'cnpj', 'razon_social'
            ]),
            1
        );
    }
}
