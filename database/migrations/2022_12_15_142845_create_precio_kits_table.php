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
        Schema::create('precio_kits', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', 10, 2);
            
            $table->foreignId('id_registro_promocion')->constrained('registro_promocions');

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
        Schema::dropIfExists('precio_kits');
    }
};
