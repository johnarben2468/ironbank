<?php
 

 
class AccountController extends BaseController {



  public function edit($id)
  {


      $exist = Account::where('id', $id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find account.');
         return Redirect::back();
      }

    $rules = array(
   
      'reg_fee' => 'required|decimal',
      'ini_dep' => 'required|decimal',
      'maintaining_bal' => 'required|decimal',
      'interest_rate' => 'required|decimal',
      'interest_interval_days' => 'required|numeric',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

        $account = Account::find($id);

        $account->reg_fee = strip_tags(Input::get('reg_fee'));
        $account->ini_dep = strip_tags(Input::get('ini_dep'));
        $account->maintaining_bal = strip_tags(Input::get('maintaining_bal'));
        $account->interest_rate = strip_tags(Input::get('interest_rate'));
        $account->interest_interval_days = strip_tags(Input::get('interest_interval_days'));
        $account->save();

        
        Session::put('msgsuccess', 'Successfully edited account.');
       

        return Redirect::to('/admin/accounts');

    }
  }
 



}