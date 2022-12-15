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
        Schema::create('precio_promocion_productos', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', 10, 2);
            
            $table->foreignId('id_promocion_producto')->constrained('promocion_productos');

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
        Schema::dropIfExists('precio_promocion_productos');
    }
};
