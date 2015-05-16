<?php
 

 
class ATMController extends BaseController {



  public function newATM()
  {
    $rules = array(
      
      'name'    => 'required|min:3|max:20',
      'address'    => 'required|min:3',
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

       
  
        $atm = new ATM;
     
        $atm->name = strip_tags(Input::get('name'));

        $atm->address = strip_tags(Input::get('address'));
         $atm->branch_id = strip_tags(Input::get('branch'));

        $atm->balance = 0;
        $atm->save();
      
        $atm = ATM::find($atm->id);
        $atm->access_key = $atm->id.substr(md5(uniqid(rand(), true)), 16, 16);
        $atm->save();

        Session::put('msgsuccess', 'You have successfully added a new atm.');
        return Redirect::to('/admin/atms');

    }
  }
  public function edit($atm_id)
  {


      $exist = ATM::where('id', $atm_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find atm.');
         return Redirect::back();
      }

    $rules = array(
      'name'    => 'required|min:3|max:100',
      'address'    => 'required|min:2',
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

        $atm = ATM::find($atm_id);

        
        $atm->name = strip_tags(Input::get('name'));

        $atm->address = strip_tags(Input::get('address'));
         $atm->branch_id = strip_tags(Input::get('branch'));

        $atm->save();

        
        Session::put('msgsuccess', 'Successfully edited atm.');
       

        return Redirect::to('/admin/atms');

    }
  }
 



  public function deactivate($atm_id)
  {

       $exist = ATM::where('id', $atm_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find ATM.');
         return Redirect::back()->withInput();
      }

        $atm = ATM::find($atm_id);
      
        $atm->status = 0;

        $atm->save();

      
        Session::put('msgsuccess', 'Successfully deactivated ATM.');
       
        return Redirect::to("/admin/atms");

    
  }


  public function activate($atm_id)
  {

       $exist = ATM::where('id', $atm_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find atm.');
         return Redirect::back()->withInput();
      }

        $atm = ATM::find($atm_id);
      
        $atm->status = 1;

        $atm->save();

      
        Session::put('msgsuccess', 'Successfully activated ATM.');
       
        return Redirect::to("/admin/atms");

    
  }

 
}