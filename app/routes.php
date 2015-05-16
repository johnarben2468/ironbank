<?php

//



Route::group(['prefix' => 'api'],  function() 
{	
	Route::get('/account/balance/access_key={access_key}', array('uses' => 'ApiATMController@balance'));	
	Route::post('/account/withdraw/access_key={access_key}', array('uses' => 'ApiATMController@withdraw'));
	Route::post('/account/change/pin/access_key={access_key}', array('uses' => 'ApiATMController@changePin'));
	Route::post('/atm/update/access_key={access_key}', array('uses' => 'ApiATMController@updateATM'));
});

Route::get('/', function()
{

	return View::make('index');
});


Route::get('/login', function()
{
	 if(Auth::check())
    	return Redirect::to("/");

	return View::make('login');
});

Route::post('login', array('uses' => 'AuthController@login', 'as'=>'login'));

Route::get('logout', array('uses' => 'AuthController@logout', 'as'=>'logout'));

Route::group(['prefix' => 'admin'],  function() 
{


Route::get('/staffs/add', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
	
		return View::make('admin.new_staffs');
	}
})->before('admin');
Route::post('/staffs/add', array('uses' => 'StaffController@newStaff'))->before('admin');
Route::get('/staffs', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$staffs = DB::table('users')->where('user_type', 1)
	            ->paginate(10);
	
		return View::make('admin.staffs')->with('staffs', $staffs);
	}
})->before('admin');
Route::get('/staffs/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = User::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit staff.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$staff = User::find($id);
		return View::make('admin.edit_staffs')->with('staff', $staff);
	}
})->before('admin');
Route::post('/staffs/edit/{id}', array('uses' => 'StaffController@edit'))->before('admin');
Route::get('/staffs/activate/{id}', array('uses' => 'StaffController@activate'))->before('admin');
Route::get('/staffs/deactivate/{id}', array('uses' => 'StaffController@deactivate'))->before('admin');


Route::get('/accounts', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$accounts = DB::table('accounts')
	            ->paginate(10);
	
		return View::make('admin.accounts')->with('accounts', $accounts);
	}
})->before('admin');
Route::get('/accounts/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = Account::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit account.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$account = Account::find($id);
		return View::make('admin.edit_accounts')->with('account', $account);
	}
})->before('admin');
Route::post('/accounts/edit/{id}', array('uses' => 'AccountController@edit'))->before('admin');


Route::get('/transactions', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$transactions = DB::table('transactions')
	            ->paginate(10);
	
		return View::make('admin.transactions')->with('transactions', $transactions);
	}
})->before('admin');
Route::get('/transactions/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = Transaction::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit transaction.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$transaction = Transaction::find($id);
		return View::make('admin.edit_transactions')->with('transaction', $transaction);
	}
})->before('admin');
Route::post('/transactions/edit/{id}', array('uses' => 'TransactionController@edit'))->before('admin');




Route::get('/atms', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$atms = DB::table('atms')
	            ->paginate(10);
	
		return View::make('admin.atms')->with('atms', $atms);
	}
})->before('admin');
Route::post('/atms/', array('uses' => 'ATMController@newATM'))->before('admin');
Route::get('/atms/activate/{id}', array('uses' => 'ATMController@activate'))->before('admin');
Route::get('/atms/deactivate/{id}', array('uses' => 'ATMController@deactivate'))->before('admin');

Route::get('/atms/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = ATM::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit atm.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$atm = ATM::find($id);
		return View::make('admin.edit_atms')->with('atm', $atm);
	}
})->before('admin');
Route::post('/atms/edit/{id}', array('uses' => 'ATMController@edit'))->before('admin');

Route::post('/positions', array('uses' => 'PositionController@newPosition'))->before('admin');
Route::get('/positions', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$positions = DB::table('positions')
	            ->paginate(10);
	
		return View::make('admin.positions')->with('positions', $positions);
	}
})->before('admin');
Route::get('/positions/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = Position::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit position.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$position = Position::find($id);
		return View::make('admin.edit_positions')->with('position', $position);
	}
})->before('admin');
Route::post('/positions/edit/{id}', array('uses' => 'PositionController@edit'))->before('admin');
Route::get('/positions/delete/{id}', array('uses' => 'PositionController@delete'))->before('admin');


Route::post('/branches', array('uses' => 'BranchController@newBranch'))->before('admin');
Route::get('/branches', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$branches = DB::table('branches')
	            ->paginate(10);
	
		return View::make('admin.branches')->with('branches', $branches);
	}
})->before('admin');
Route::get('/branches/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = Branch::where('id', $id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit branch.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$branch = Branch::find($id);
		return View::make('admin.edit_branches')->with('branch', $branch);
	}
})->before('admin');
Route::post('/branches/edit/{id}', array('uses' => 'BranchController@edit'))->before('admin');
Route::get('/branches/delete/{id}', array('uses' => 'BranchController@delete'))->before('admin');


});



Route::post('/edit/account', array('uses' => 'MemberController@editProfile', 'as'=>'/edit/account'));
Route::get('/edit/account', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('account', 1);
		 $exist = User::where('id', Auth::user()->id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit member.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$user = User::find(Auth::user()->id);
		return View::make('members.edit_profile')->with('user', $user);
	}


});

Route::group(['prefix' => 'staff'],  function() 
{



Route::get('/registrations', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$users = DB::table('users')->where("status", 0)->where("note", "!=", "")
	            ->paginate(10);
	
		return View::make('staff.registrations')->with('users', $users);
	}
})->before('reg');
Route::get('/registrations/approve/{id}', array('uses' => 'MemberController@approve'))->before('reg');
Route::get('/registrations/decline/{id}', array('uses' => 'MemberController@decline'))->before('reg');

Route::get('/deposit', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
	
	
		return View::make('staff.deposit');
	}
})->before('transact_deposit');

Route::post('/deposit', array('uses' => 'TransactionController@deposit'))->before('transact_deposit');


Route::get('/withdraw', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
	
	
		return View::make('staff.withdraw');
	}
})->before('transact_withdraw');

Route::post('/withdraw', array('uses' => 'TransactionController@withdraw'))->before('transact_withdraw');



Route::get('/transfer', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
	
	
		return View::make('staff.transfer');
	}
})->before('transact_transfer');

Route::post('/transfer', array('uses' => 'TransactionController@transfer'))->before('transact_transfer');





	
Route::get('/staffs/add', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
	
		return View::make('staff.new_staffs');
	}
})->before('manage_staff');
Route::post('/staffs/add', array('uses' => 'StaffController@SnewStaff'))->before('staff');
Route::get('/staffs', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$staffs = DB::table('users')->where('user_type', 1)->where('branch_id', Auth::user()->branch_id)
	            ->paginate(10);
	
		return View::make('staff.staffs')->with('staffs', $staffs);
	}
})->before('manage_staff');
Route::get('/staffs/edit/{id}', function($id)
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		 $exist = User::where('id', $id)->where('branch_id', Auth::user()->branch_id)->count();

    	if($exist == 0)
    	{
      	Session::put('msgfail', 'Failed to edit staff.');
      	return Redirect::back()
        ->withInput(); 
    	}

		$staff = User::find($id);
		return View::make('staff.edit_staffs')->with('staff', $staff);
	}
})->before('manage_staff');
Route::post('/staffs/edit/{id}', array('uses' => 'StaffController@Sedit'))->before('manage_staff');
Route::get('/staffs/activate/{id}', array('uses' => 'StaffController@Sactivate'))->before('manage_staff');
Route::get('/staffs/deactivate/{id}', array('uses' => 'StaffController@Sdeactivate'))->before('manage_staff');




Route::get('/savings', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		$accountinfo = Account::where('type', 'Savings')->first();
		Session::put('management', 1);
		$accounts = DB::table('account_entries')->where("card_id", "!=", 0)->where('account_id', $accountinfo->id)
	            ->paginate(10);
	
		return View::make('staff.savings')->with('accounts', $accounts);
	}
})->before('manage_acc_sav');


Route::get('/savings/activate/{id}', function($id)
{
     $exist = AccountEntry::where('id', $id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find account.');
         return Redirect::back()->withInput();
      }

        $account = AccountEntry::find($id);
      
        $account->status = 1;

        $account->save();

      
        Session::put('msgsuccess', 'Successfully activated account.');
       
        return Redirect::to("/staff/savings");

})->before('manage_acc_sav');


Route::get('/savings/deactivate/{id}', function($id)
{
     $exist = AccountEntry::where('id', $id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find account.');
         return Redirect::back()->withInput();
      }

        $account = AccountEntry::find($id);
      
        $account->status = 0;

        $account->save();

      
        Session::put('msgsuccess', 'Successfully deactivated account.');
       
        return Redirect::to("/staff/savings");

})->before('manage_acc_sav');

Route::get('/timdep', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{

		Session::put('management', 1);
		$accounts = DB::table('account_entries')->Where('account_id', 2)
	            ->paginate(10);
	
		return View::make('staff.timdep')->with('accounts', $accounts);
	}
})->before('manage_acc_tim');


Route::get('/timdep/activate/{id}', function($id)
{
     $exist = AccountEntry::where('id', $id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find account.');
         return Redirect::back()->withInput();
      }

        $account = AccountEntry::find($id);
      
        $account->status = 1;

        $account->save();

      
        Session::put('msgsuccess', 'Successfully activated account.');
       
        return Redirect::to("/staff/timdep");

})->before('manage_acc_tim');


Route::get('/timdep/deactivate/{id}', function($id)
{
     $exist = AccountEntry::where('id', $id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find account.');
         return Redirect::back()->withInput();
      }

        $account = AccountEntry::find($id);
      
        $account->status = 0;

        $account->save();

      
        Session::put('msgsuccess', 'Successfully deactivated account.');
       
        return Redirect::to("/staff/timdep");

})->before('manage_acc_tim');


Route::get('/audit', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$transactions = DB::table('transaction_entries')->where('branch_id', Auth::user()->branch_id)->orderBy('created_at', 'DESC')
	            ->paginate(10);
	
		return View::make('staff.audit')->with('transactions', $transactions);
	}
})->before('audit_trail');

});


//











Route::get('/register', function()
{

	return View::make('register');

});
Route::post('register', array('uses' => 'AuthController@register', 'as'=>'register'));



Route::post('/resetpassword', array('uses' => 'MemberController@resetPassword', 'as'=>'/resetpassword'));

Route::get('/simulation', function()
{

	return View::make('simulate.info');

});

Route::get('/simulation/authentication', function()
{

	return View::make('simulate.atm');

});
Route::post('/simulation/authentication', array('uses' => 'ApiMockATMController@authentication', 'as'=>'authentication'));

Route::get('/simulation/atmupdate', function()
{

	return View::make('simulate.atmupdate');

});
Route::post('/simulation/atmupdate', array('uses' => 'ApiMockATMController@atmupdate', 'as'=>'atmupdate'));

Route::get('/simulation/balance', function()
{
	if(Session::get('saved_card_id')&&Session::get('saved_pincode')&&Session::get('saved_access_key'))
	{ 
	$entryLook = AccountEntry::where('card_id', Session::get('saved_card_id'))->where('status', 1)->first();
	Session::put('msgsuccess', "Your account balance is ".$entryLook->balance." pesos.");
 	}
        
     
	return View::make('simulate.atmbalance');
});

Route::get('/simulation/withdraw', function()
{

	return View::make('simulate.atmwithdraw');

});
Route::post('/simulation/withdraw', array('uses' => 'ApiMockATMController@withdraw', 'as'=>'withdraw'));

Route::get('/simulation/changepin', function()
{

	return View::make('simulate.atmchangepin');

});
Route::post('/simulation/changepin', array('uses' => 'ApiMockATMController@changepin', 'as'=>'changepin'));

Route::get('/track', function()
{
    if(!Auth::check())
    	return Redirect::to("/login");
	else
	{
		Session::put('management', 1);
		$account = AccountEntry::where("user_id", Auth::user()->id)->where("account_id",1)->first();
		$transactions = DB::table('transaction_entries')->where('account_entry_id',$account->id)->orderBy('created_at', 'DESC')
	            ->paginate(10);
	
		return View::make('members.track')->with('transactions', $transactions);
	}
});