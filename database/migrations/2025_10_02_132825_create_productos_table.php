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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 180);
            $table->string('slug', 200)->unique()->nullable();
            $table->text('descripcion')->nullable();
            $table->text('adicional')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->tinyInteger('destacado')->default('1');
            $table->tinyInteger('mejor_vendido')->default('1');
            $table->tinyInteger('recien_llegado')->default('1');
            $table->tinyInteger('en_venta')->default('1');
            $table->float('precio',6)->nullable();
            $table->float('dscto',6)->nullable();
            $table->float('precio_dscto',6)->nullable();
            $table->tinyInteger('cantidad');
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
        Schema::dropIfExists('productos');
    }
};
