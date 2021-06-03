<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'establishment_id' => null,
            'cep' => '95082-380',
            'logradouro' => 'Avenida Independência',
            'complemento' => '1358',
            'bairro' => 'Cristo Redentor',
            'localidade' => 'Caxias do Sul',
            'uf' => 'RS',
        ];
    }
}
