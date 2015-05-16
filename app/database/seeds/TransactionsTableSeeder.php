<?php

class TransactionsTableSeeder extends Seeder {

	public function run()
	{
		
		Transaction::create([
			'type' => "ATM_Withdraw",
			'fee' => 0.50,
		
			]);

		Transaction::create([
			'type' => "Counter_Withdraw",
			'fee' => 0.50,
		
			]);
		Transaction::create([
			'type' => "Counter_Deposit",
			'fee' => 0.50,
		
			]);
		Transaction::create([
			'type' => "Counter_Transfer",
			'fee' => 0.50,
		
			]);
	}
}