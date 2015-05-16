<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		Branch::create([
			'address' => 'Central Manila',
			'name' => 'Command Center',
			'contact_number' => '089786666',
 			]);
		Position::create([
			'title' => 'superadmin',
			'reg' => 1,
			
			'manage_staff' => 1,
			'manage_acc_sav' => 1,
			'manage_acc_tim' => 1,
			'audit_trail' => 1,
			'transact_deposit' => 1,
			'transact_withdraw' => 1,
			'transact_transfer' => 1,
			]);
		User::create([
			'email' => 'superadmin@gmail.com',
			'password' => Hash::make("superadmin"),
			'status' => 1,
			'firstname' => 'john arben nicole',
			'middlename' => 'delica',
			'lastname' => 'hombrebueno',
			'contact_number' => '0924666778',
			'address'	=>	'Central Manila',
			'user_type' => 2,
			'branch_id' => 1,
			'position_id' => 1,
			]);
	}
}