<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nota', function(Blueprint $table)
		{
			$table->bigIncrements('CDNOTA');
			$table->integer('CDMATDISCIPLINA')->nullable();
			$table->decimal('NOTA', 7)->nullable();
			$table->string('REFERENCIA', 20)->nullable();
			$table->char('STATUS', 2)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nota');
	}

}
