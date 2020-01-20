<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matricula', function(Blueprint $table)
		{
			$table->bigIncrements('CDMATRICULA');
			$table->integer('CDCURSO')->nullable();
			$table->integer('CDALUNO')->nullable();
			$table->integer('CDSEMESTRE')->nullable();
			$table->decimal('VALOR', 7)->nullable();
			$table->integer('CDTURMA')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matricula');
	}

}
