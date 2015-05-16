<?php

class AuthController extends BaseController {


	public function logout()
	{
		Auth::logout();
		Session::flush();
		return Redirect::to('/')->with('msgsuccess','You have logged out.');	
	}

	
	public function login()
	{
		$userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

		if (Auth::Attempt($userdata)) 
		{
			$checkUser = User::find(Auth::id());
      if($checkUser->status==0)
      {
        Auth::logout();
        return Redirect::back()->withInput(Input::except('password'))->with( 'msgfail' , 'You account is not activated. Please contact a library personel to activate your account.' );
      }
		
			return Redirect::to('/')->with( 'msgsuccess' , 'You have logged in successfully.');

		}

		return Redirect::back()->withInput(Input::except('password'))->with( 'msgfail', 'Invalid credentials.');
	}

	

	

  public function register()
  {
   
    $rules = array(
      
      'password'    => 'required|min:3|max:20|confirmed',
      'password_confirmation'    => 'required',
      'email'    => 'required|email|min:3|max:100|unique:users',
      'firstname'    => 'required|min:2|max:100',
      'middlename'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
      'address'    => 'required|min:2|max:100',
      'contact_number'    => 'required|min:7|max:20',
    	'account'	=> 'required',
    
    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else {
  
        $user = new User;
     
        $user->email = strip_tags(Input::get('email'));

        $user->password = strip_tags(Hash::make(Input::get('password')));

        $user->firstname = strip_tags(Input::get('firstname'));

        $user->middlename = strip_tags(Input::get('middlename'));
        
        $user->lastname = strip_tags(Input::get('lastname'));
        
        $user->contact_number = strip_tags(Input::get('contact_number'));

        $user->address = strip_tags(Input::get('address'));

        $user->user_type = 0;

        $user->status = 0;

        $accounts = Input::get('account');

        $note = " ";

        foreach ($accounts as $account) {

        	$note.=$account;

          
        }
        $user->note = $note;

        $user->save();
      

        foreach ($accounts as $account) {

          $note.=$account;

          $checkType = Account::where("type", $account)->count();
          if ($checkType!=0)
          {

             $accountInfo = Account::where("type", $account)->first();
            $entry = new AccountEntry;
            $entry->user_id = $user->id;
            $entry->card_id = 0;
            $entry->status = 0;
            $entry->balance = 0;
            $entry->account_id = $accountInfo->id;
            $entry->save();
          }
        }

        Session::put('msgsuccess', 'You have successfully registered online. Please proceed to the next step of the registration.');
        return Redirect::to('/');
  }

}
}