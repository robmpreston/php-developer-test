<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelationsTable extends Migration {

	public function up()
	{
		Schema::create('relations', function(Blueprint $table) {
			$table->integer('person_id')->unsigned();
			$table->foreign('person_id')->references('id')->on('people');
			$table->integer('father_id')->unsigned();
			$table->integer('mother_id')->unsigned();
			$table->integer('spouse_id')->unsigned();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('relations');
	}
}
