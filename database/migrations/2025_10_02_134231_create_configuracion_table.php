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
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_web', 180);
            $table->string('logo', 100);
            $table->string('favicon', 150);
            $table->string('direccion', 255);
            $table->string('telefono', 50);
            $table->string('email', 100);
            $table->string('facebook', 255);
            $table->string('twitter', 255);
            $table->string('linkedin', 255);
            $table->string('tiktok', 255);
            $table->string('wasap', 255);
            $table->string('instagram', 255);
            $table->string('copyright', 255);
            $table->text('mapa_iframe');
            $table->string('meta_title', 255);
            $table->string('meta_descripcion', 255);
            $table->string('meta_keywords', 255);
            $table->string('og_imagen', 255);
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
        Schema::dropIfExists('configuracion');
    }
};
