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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('department_name')->nullable()->comment('Nome do setor resp. pelas marcas');
            $table->integer('years_validity')->nullable()->comment('Validade das marcas em anos');
            $table->string('cnpj')->nullable()->comment('CNPJ do órgão');
            $table->string('city')->nullable()->comment('Nome do município');
            $table->varchar('state', 2)->nullable()->comment('UF');
            $table->string('phone')->nullable()->comment('Telefone do órgão');
            $table->string('address')->nullable()->comment('Endereço do órgão');
            $table->date('renewal_deadline')->nullable()->comment('Data limite para renovação das marcas');
            $table->boolean('show_report_header')->default(1)->comment('Cabeçalho nos relatórios');
            $table->boolean('show_report_watermark')->default(1)->comment('Marca dágua nos relatórios');
            $table->boolean('show_note_on_brand_title')->default(0)->comment('Mostrar observação no título da marca');
            $table->boolean('suggest_brand_number')->default(1)->comment('Sugerir número da marca');
            $table->boolean('show_signals_on_brand_title')->default(0)->comment('Mostrar sinais no título da marca');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
