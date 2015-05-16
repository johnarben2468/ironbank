<?php
 

 
class MemberController extends BaseController {
 
 
  public function edit($member_id)
  {


      $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find member.');
         return Redirect::back();
      }

    $rules = array(
      'username'    => 'required|alphaNum|min:3|max:20', 
      'email'    => 'required|email|min:3|max:100',
      'name'    => 'required|min:3|max:100',
      'member_type'    => 'required|numeric',

    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {
       
    

        $user = User::find($member_id);

        if(Input::get('username')!= $user->username)
        $user->username = strip_tags(Input::get('username'));

        if(Input::get('email')!=$user->email)
        $user->email = strip_tags(Input::get('email'));

        $user->name = strip_tags(Input::get('name'));

        $user->member_type_id = strip_tags(Input::get('member_type'));
        $user->save();

        
        Session::put('msgsuccess', 'Successfully edited user.');
       

        return Redirect::to('/admin/members');

    }
  }
 



  public function deactivate($member_id)
  {

       $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($member_id);
      
        $member->status = 0;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully deactivated user.');
       
        return Redirect::to("/admin/members");

    
  }


  public function activate($member_id)
  {

       $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($member_id);
      
        $member->status = 1;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully activated user.');
       
        return Redirect::to("/admin/members");

    
  }
  public function resetPassword()
  {

       $exist = User::where('email', Input::get('email'))->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find email.');
         return Redirect::back()->withInput();
      }

        $user =User::where('email', Input::get('email'))->first();
        $member = User::find($user->id);
        $pass = substr(md5(uniqid(rand(), true)), 16, 16);
        $member->password = Hash::make($pass);

        $member->save();

        Session::put('userPassword', $pass);
        
        Mail::send('emails.password_reset', array('key' => 'value'), function($message)
               {
                   $message->from('lsapi@gmail.com', 'Library System');
                   $message->to(Input::get('email'), 'Library System')->subject('Your password has been reset.');
               });
      
        Session::put('msgsuccess', 'Your new password has been sent to your email.');
       
        
      
        return Redirect::to("/");

    
  }

  public function editProfile()
  {


    $rules = array(
      'email'    => 'required|email|min:3|max:100',
      'firstname'    => 'required|min:2|max:100',
      'middlename'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
      'contact_number'    => 'required|min:7|max:20',

    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {
       
    

        $user = User::find(Auth::user()->id);


        if(Input::get('email')!=$user->email)
        $user->email = strip_tags(Input::get('email'));

        $user->firstname = strip_tags(Input::get('firstname'));

        $user->middlename = strip_tags(Input::get('middlename'));
        
        $user->lastname = strip_tags(Input::get('lastname'));

        $user->contact_number = strip_tags(Input::get('contact_number'));

        $user->save();

        
        Session::put('msgsuccess', 'Successfully edited profile.');
       

        return Redirect::to('/edit/account');

    }
  }
 
 

  public function approve($member_id)
  {

       $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($member_id);
      
        $member->status = 1;

        $member->save();

        $accounts = AccountEntry::where("user_id", $member->id)->get();

        foreach ($accounts as $account) {

          $accountUpdate = AccountEntry::find($account->id);
          $accountUpdate->status = 1;

          if($account->account_id == 1){
            
          $card = new Card;
          $card->pincode = 1234;
          $card->status = 1;
          $card->save();
          $accountUpdate->card_id = $card->id;

          }
          else{
            $accountUpdate->card_id = 0;
          }

          $accountInfo = Account::find($account->account_id);

          $accountUpdate->balance =  $accountInfo->ini_dep;
          $accountUpdate->account_code = "2015"."4"."7".$account->id;
          $accountUpdate->save();
        }
      
        Session::put('msgsuccess', 'Successfully approved user.');
       
        return Redirect::back();

    
  }


  public function decline($member_id)
  {

       $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        User::where('id', $member_id)->delete();
      

         AccountEntry::where("user_id", $member->id)->delete();



      
        Session::put('msgsuccess', 'Successfully declined user.');
       
        return Redirect::to("/staff/registrations");

    
  }
}