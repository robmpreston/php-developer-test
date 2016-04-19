<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration {

	public function up()
	{
		Schema::create('people', function(Blueprint $table) {
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('people');
	}
}
