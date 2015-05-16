<?php

class AccountsTableSeeder extends Seeder {

	public function run()
	{
		Account::create([
			'type' => "Savings",
			'reg_fee' => 100.00,
			'ini_dep' => 1000.00,
			'maintaining_bal' => 1000.00,
			'interest_rate' => 0.0005,
			'interest_interval_days' => 256,
			]);
		Account::create([
			'type' => "Time Deposit",
			'reg_fee' => 100.00,
			'ini_dep' => 10000.00,
			'maintaining_bal' => 10000.00,
			'interest_rate' => 0.0500,
			'interest_interval_days' => 256,
			]);
	

	}
}