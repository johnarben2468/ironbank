<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration {

	public function up()
	{
		Schema::create('positions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->nullable();
			$table->integer('reg')->nullable();
			
			$table->integer('manage_staff')->nullable();
			$table->integer('manage_acc_sav')->nullable();
			$table->integer('manage_acc_tim')->nullable();
			$table->integer('audit_trail')->nullable();
			$table->integer('transact_deposit')->nullable();
			$table->integer('transact_withdraw')->nullable();
			$table->integer('transact_transfer')->nullable();
			
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
		Schema::drop('positions');
	}

}
