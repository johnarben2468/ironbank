<?php
 

 
class StaffController extends BaseController {



  public function newStaff()
  {
    $rules = array(
      
      'password'    => 'required|min:3|max:20|confirmed',
      'password_confirmation'    => 'required',
      'email'    => 'required|email|min:3|max:100|unique:users',
      'firstname'    => 'required|min:2|max:100',
      'middlename'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
      'contact_number'    => 'required|min:7|max:20',
      'position'    => 'required|numeric',
      'branch'    => 'required|numeric',
    
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

        $user->position_id = strip_tags(Input::get('position'));

        $user->branch_id = strip_tags(Input::get('branch'));

        $user->user_type = 1;

        $user->status = 1;

        $user->save();
      
        Session::put('msgsuccess', 'You have successfully added a new staff.');
        return Redirect::to('/admin/staffs');

    }
  }
  public function edit($staff_id)
  {


      $exist = User::where('id', $staff_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find member.');
         return Redirect::back();
      }

    $rules = array(
      'email'    => 'required|email|min:3|max:100',
      'firstname'    => 'required|min:2|max:100',
      'middlename'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
      'contact_number'    => 'required|min:7|max:20',
      'position'    => 'required|numeric',
      'branch'    => 'required|numeric',
      'user_type'    => 'required|numeric',

    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

        $user = User::find($staff_id);

        
        $user->firstname = strip_tags(Input::get('firstname'));

        $user->middlename = strip_tags(Input::get('middlename'));
        
        $user->lastname = strip_tags(Input::get('lastname'));

        if(Input::get('email')!= $user->email)
        $user->email = strip_tags(Input::get('email'));

        $user->contact_number = strip_tags(Input::get('contact_number'));

        $user->position_id = strip_tags(Input::get('position'));

        $user->branch_id = strip_tags(Input::get('branch'));

        $user->user_type = strip_tags(Input::get('user_type'));

        $user->save();

        
        Session::put('msgsuccess', 'Successfully edited user.');
       

        return Redirect::to('/admin/staffs');

    }
  }
 



  public function deactivate($staff_id)
  {

       $exist = User::where('id', $staff_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($staff_id);
      
        $member->status = 0;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully deactivated user.');
       
        return Redirect::to("/admin/staffs");

    
  }


  public function activate($staff_id)
  {

       $exist = User::where('id', $staff_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($staff_id);
      
        $member->status = 1;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully activated user.');
       
        return Redirect::to("/admin/staffs");

    
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


      $exist = User::where('id', Auth::user()->id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find member.');
         return Redirect::back();
      }

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

        
        $user->firstname = strip_tags(Input::get('firstname'));

        $user->middlename = strip_tags(Input::get('middlename'));
        
        $user->lastname = strip_tags(Input::get('lastname'));

        if(Input::get('email')!= $user->email)
        $user->email = strip_tags(Input::get('email'));

        $user->contact_number = strip_tags(Input::get('contact_number'));

        $user->save();

        
        Session::put('msgsuccess', 'Successfully edited profile.');
       

        return Redirect::to('/edit/account');

    }
  }



  //



  public function SnewStaff()
  {
    $rules = array(
      
      'password'    => 'required|min:3|max:20|confirmed',
      'password_confirmation'    => 'required',
      'email'    => 'required|email|min:3|max:100|unique:users',
      'firstname'    => 'required|min:2|max:100',
      'middlename'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
      'contact_number'    => 'required|min:7|max:20',
      'position'    => 'required|numeric',
      
    
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

        $user->position_id = strip_tags(Input::get('position'));

        $user->branch_id = Auth::user()->branch_id;

        $user->user_type = 1;

        $user->status = 1;

        $user->save();
      
        Session::put('msgsuccess', 'You have successfully added a new staff.');
        return Redirect::to('/staff/staffs');

    }
  }
  public function Sedit($staff_id)
  {


      $exist = User::where('id', $staff_id)->where('branch_id', Auth::user()->branch_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find member.');
         return Redirect::back();
      }

    $rules = array(
      'email'    => 'required|email|min:3|max:100',
      'firstname'    => 'required|min:2|max:100',
      'middlename'    => 'required|min:2|max:100',
      'lastname'    => 'required|min:2|max:100',
      'contact_number'    => 'required|min:7|max:20',
      'position'    => 'required|numeric',
     

    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

        $user = User::find($staff_id);

        
        $user->firstname = strip_tags(Input::get('firstname'));

        $user->middlename = strip_tags(Input::get('middlename'));
        
        $user->lastname = strip_tags(Input::get('lastname'));

        if(Input::get('email')!= $user->email)
        $user->email = strip_tags(Input::get('email'));

        $user->contact_number = strip_tags(Input::get('contact_number'));

        $user->position_id = strip_tags(Input::get('position'));

        $user->branch_id = Auth::user()->branch_id;

        $user->user_type = 1;

        $user->save();

        
        Session::put('msgsuccess', 'Successfully edited user.');
       

        return Redirect::to('/staff/staffs');

    }
  }
 



  public function Sdeactivate($staff_id)
  {

       $exist = User::where('id', $staff_id)->where('branch_id', Auth::user()->branch_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($staff_id);
      
        $member->status = 0;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully deactivated user.');
       
        return Redirect::to("/staff/staffs");

    
  }


  public function Sactivate($staff_id)
  {

       $exist = User::where('id', $staff_id)->where('branch_id', Auth::user()->branch_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($staff_id);
      
        $member->status = 1;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully activated user.');
       
        return Redirect::to("/staff/staffs");

    
  }






 
}