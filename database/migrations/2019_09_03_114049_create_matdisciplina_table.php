<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatdisciplinaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matdisciplina', function(Blueprint $table)
		{
			$table->bigIncrements('CDMATDISCIPLINA');
			$table->integer('CDMATRICULA')->nullable()->index('CDMATRICULA');
			$table->integer('CDDISCIPLINA')->nullable();
			$table->decimal('MEDIA', 7)->nullable();
			$table->char('STATUS', 2)->nullable();
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
		Schema::drop('matdisciplina');
	}

}
