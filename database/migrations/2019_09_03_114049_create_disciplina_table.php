<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDisciplinaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disciplina', function(Blueprint $table)
		{
			$table->bigIncrements('CDDISCIPLINA');
			$table->string('NOMEDISCIPLINA', 40)->nullable();
			$table->integer('CDPROFESSOR')->nullable();
			$table->decimal('VALOR', 7)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('disciplina');
	}

}
