<?php
 

 
class PositionController extends BaseController {


  public function newPosition()
  {
    $rules = array(
      
      'title'    => 'required|min:3|max:20|unique:positions',

    
    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else {
  
        $position = new Position;
     
        $position->title = strip_tags(Input::get('title'));

        $positionsArr = array(
        "reg",
       
        "manage_staff",
        "manage_acc_sav",
        "manage_acc_tim",
        "audit_trail",
        "transact_deposit",
        "transact_withdraw",
        "transact_transfer",
          );

        if(Input::get('roles')!=NULL)
        {
        $roles = Input::get('roles');
        

        foreach ($positionsArr as $positionArr) {
          $checkPos =0;
          foreach ($roles as $role) {

            if ($role==$positionArr)
            {
              $position->$positionArr = 1;
              $checkPos =1;

            }

          }
          if($checkPos==0)
          {
            $position->$positionArr = 0;
          }
        }
        }
        else
        {
          foreach ($positionsArr as $positionArr) {
          
            $position->$positionArr = 0;
          
          }
        }
        $position->save();
      
        Session::put('msgsuccess', 'You have successfully added a new position.');
        return Redirect::to('/admin/positions');

    }
  }
  public function edit($position_id)
  {


      $exist = Position::where('id', $position_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find position.');
         return Redirect::back();
      }

    $rules = array(
      
      'title'    => 'required|min:3|max:20',

    
    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else {
  

        $position = Position::find($position_id);
     
        $position->title = strip_tags(Input::get('title'));

        $positionsArr = array(
        "reg",
       
        "manage_staff",
        "manage_acc_sav",
        "manage_acc_tim",
        "audit_trail",
        "transact_deposit",
        "transact_withdraw",
        "transact_transfer",
          );

       
        if(Input::get('roles')!=NULL)
        {
        $roles = Input::get('roles');
        

        foreach ($positionsArr as $positionArr) {
          $checkPos =0;
          foreach ($roles as $role) {

            if ($role==$positionArr)
            {
              $position->$positionArr = 1;
              $checkPos =1;

            }

          }
          if($checkPos==0)
          {
            $position->$positionArr = 0;
          }
        }
        }
        else
        {
          foreach ($positionsArr as $positionArr) {
          
            $position->$positionArr = 0;
          
          }
        }

        $position->save();
      
        Session::put('msgsuccess', 'You have successfully edited position.');
        return Redirect::to('/admin/positions');

    }
  }
 



  public function delete($position_id)
  {

       $exist = Position::where('id', $position_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Failed to find position.');
         return Redirect::back()->withInput();
      }

        
        $checkUsers = User::where("position_id", $position_id)->count();

        if($checkUsers!=0){
          Session::put('msgfail', 'Failed delete position. Please assure that no employee is assigned to this position.');
         return Redirect::back()->withInput();
        }

        Position::where("id", $position_id)->delete();
      
        Session::put('msgsuccess', 'Successfully deleted position.');
       
        return Redirect::to("/admin/positions");

    
  }



 
}