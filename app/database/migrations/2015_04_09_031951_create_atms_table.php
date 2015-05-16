<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtmsTable extends Migration {

public function up()
	{
		Schema::create('atms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('branch_id');
			$table->string('address');
			$table->string('access_key');
			$table->integer('status');
			$table->double( 'balance', 15, 3 );
			$table->double( 'lat', 15, 3 );
			$table->double( 'long', 15, 3 );
			$table->integer('deno_fivecen');
			$table->integer('deno_tencen');
			$table->integer('deno_twentyfivecen');
			$table->integer('deno_onepeso');
			$table->integer('deno_fivepeso');
			$table->integer('deno_tenpeso');
			$table->integer('deno_twentypeso');
			$table->integer('deno_fiftypeso');
			$table->integer('deno_onehundredpeso');
			$table->integer('deno_twohundredpeso');
			$table->integer('deno_fivehundredpeso');
			$table->integer('deno_onethousandpeso');
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
		Schema::drop('atms');
	}
}
