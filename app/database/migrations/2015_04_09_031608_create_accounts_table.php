<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {

public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->double( 'reg_fee', 15, 3 );
			$table->double( 'ini_dep', 15, 3 );
			$table->double( 'maintaining_bal', 15, 3 );
			$table->double( 'interest_rate', 15, 8 );
			$table->double( 'interest_interval_days', 15, 8 );
			
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
		Schema::drop('accounts');
	}

}
