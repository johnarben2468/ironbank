<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_type')->nullable();
			$table->integer('position_id')->nullable();
			$table->integer('branch_id')->nullable();
			$table->string('firstname')->nullable();
			$table->string('middlename')->nullable();
			$table->string('lastname')->nullable();
			$table->string('address')->nullable();
			$table->double('lat', 15, 3)->nullable();
			$table->double('long', 15, 3)->nullable();
			$table->string('contact_number')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->date('birthday')->nullable();
			
			$table->string('credential')->nullable();
			$table->integer('status')->nullable();
			$table->string('remember_token');
			$table->string('note');
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
		Schema::drop('users');
	}

}
