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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad');
            

            $table->foreignId('id_producto')->nullable()->constrained('productos');
            $table->foreignId('id_registro_promocion')->nullable()->constrained('registro_promocions');
            $table->foreignId('id_promocion_producto')->nullable()->constrained('promocion_productos');

            $table->foreignId('id_venta')->constrained('ventas');

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
        Schema::dropIfExists('detalle_ventas');
    }
};
