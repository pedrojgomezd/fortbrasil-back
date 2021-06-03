<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_id');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('localidade');
            $table->string('uf');
            $table->timestamps();

            $table->foreign('establishment_id')
                ->references('id')
                ->on('establishments');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
