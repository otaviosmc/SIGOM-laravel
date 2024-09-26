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
        Schema::create('situacao', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('blocos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('area', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('bloco_id')
                  ->constrained('bloco');
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('ocorrencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
                  ->constrained('users');
            $table->foreignId('bloco_id')
                  ->constrained('bloco');
            $table->foreignId('area_id')
                  ->constrained('area');
            $table->foreignId('situacao_id')
                  ->constrained('situacao');
            $table->string('descricao');
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('atendente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')
                  ->constrained('ocorrencia');
            $table->foreignId('usuario_id')
                  ->constrained('users');
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('imagem_ocorrencia', function (Blueprint $table) {
            $table->id();
            $table->binary('imagem');
            $table->foreignId('ocorrencia_id')
                  ->constrained('ocorrencia');
            $table->date('created_at');
            $table->date('updated_at');
        });

        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situacao');
        Schema::dropIfExists('bloco');
        Schema::dropIfExists('area');
        Schema::dropIfExists('ocorrencia');
        Schema::dropIfExists('atendente');
        Schema::dropIfExists('imagem_ocorrencia');
    }
};
