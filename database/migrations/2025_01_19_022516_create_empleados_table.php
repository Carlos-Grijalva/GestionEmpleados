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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('idempleado');
            $table->string('nombre', 100);
            $table->string('primer_apellido', 100);
            $table->string('segundo_apellido', 100);
            $table->string('email')->unique();
            $table->foreignId('idcargo')->constrained('cargos', 'idcargo');
            $table->foreignId('idnivel')->constrained('niveles', 'idnivel');
            $table->date('fecha_contratacion');
            $table->string('url_imagen_relativa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
