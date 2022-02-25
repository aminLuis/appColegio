<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificacion')->nullable();
            $table->string('grado')->nullable();
            $table->string('docente')->nullable();
            $table->string('asignatura')->nullable();
            $table->string('descripcion_nota')->nullable();
            $table->string('valor_nota')->nullable();
            $table->string('delete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_estudiantes');
    }
}
