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
        Schema::create('registro_promocions', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('imagen');
            $table->integer('descuento');
            $table->integer('cantidad_inicial');
            $table->integer('cantidad_restante'); // esta debe ser igual que la de arriba en un principio y luego irse restando
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->foreignId('id_situacion_promocion')->constrained('situacion_promocions');
            $table->foreignId('id_tipo_promocion')->constrained('tipo_promocions');
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
        Schema::dropIfExists('registro_promocions');
    }
};
