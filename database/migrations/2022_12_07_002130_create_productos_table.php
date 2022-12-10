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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio', 10, 2)->default(0);
            $table->decimal('peso', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->string('imagen');
            $table->boolean('estado')->default(1);
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->foreignId('id_marca')->constrained('marcas');
            $table->foreignId('id_tipo_peso')->constrained('tipo_pesos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
