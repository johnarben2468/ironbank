<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountEntriesTable extends Migration {
public function up()
	{
		Schema::create('account_entries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('account_id');
			$table->integer('account_code');
			$table->integer('card_id');
			$table->integer('status');
			$table->double( 'balance', 15, 3 );
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
		Schema::drop('account_entries');
	}

}
