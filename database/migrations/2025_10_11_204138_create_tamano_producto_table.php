<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tamano_producto', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('tamano_id');
            $table->foreign('tamano_id')->references('id')->on('tamano');            
            $table->BigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->tinyInteger('status')->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamano_producto');
    }
};
