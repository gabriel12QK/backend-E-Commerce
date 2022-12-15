<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_venta')->constrained('ventas'); //esta es la compra
            $table->foreignId('id_repartidor')->constrained('users'); //este es una usuario de tipo repartidor
            $table->string('latitud');
            $table->string('longitud');
            $table->decimal('total', 10, 2);
            $table->string('cod_comprobante');//cod para que el repartidor y el cliente comprueben el pedido
            $table->foreignId('id_estado_orden')->constrained('estado_ordens');

            $table->boolean('estado');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens');
    }
};
