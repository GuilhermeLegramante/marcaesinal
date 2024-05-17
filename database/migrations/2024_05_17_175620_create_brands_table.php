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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained('farmers')->cascadeOnDelete();
            $table->integer('number')->nullable();
            $table->integer('original_number')->nullable();
            $table->integer('year')->nullable();
            $table->integer('original_year')->nullable();
            $table->string('situation')->nullable()->comment('Situação => Baixada, Suspensa, Liberada');
            $table->string('filename')->comment('Nome do arquivo da imagem da marca');
            $table->string('path')->nullable()->comment('Caminho completo da imagem da marca');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
