<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionEntriesTable extends Migration {

	public function up()
	{
		Schema::create('transaction_entries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_entry_id');
			$table->integer('staff_id');
			$table->integer('atm_id');
			$table->double( 'amount', 15, 3 );
			$table->double( 'fee', 15, 3 );
			$table->integer('transaction_id');
			$table->integer('branch_id');
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
		Schema::drop('transaction_entries');
	}

}
