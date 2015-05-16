<?php
 

 
class BranchController extends BaseController {


  public function newBranch()
  {
    $rules = array(
      
      'name'    => 'required|min:3|max:20|unique:branches',
      'address'    => 'required|min:3|max:20',
      'contact_number'    => 'required|min:3|max:20',
    
    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else {
  
        $branch = new Branch;
     
        $branch->name = strip_tags(Input::get('name'));
        $branch->address = strip_tags(Input::get('address'));
        $branch->contact_number = strip_tags(Input::get('contact_number'));

        $branch->save();
      
        Session::put('msgsuccess', 'You have successfully added a new branch.');
        return Redirect::to('/admin/branches');

    }
  }
  public function edit($branch_id)
  {


      $exist = Branch::where('id', $branch_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find branch.');
         return Redirect::back();
      }

   $rules = array(
      
      'name'    => 'required|min:3|max:20',
      'address'    => 'required|min:3|max:20',
      'contact_number'    => 'required|min:3|max:20',
    
    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else {
  
        $branch = Branch::find($branch_id);
     
        $branch->name = strip_tags(Input::get('name'));
        $branch->address = strip_tags(Input::get('address'));
        $branch->contact_number = strip_tags(Input::get('contact_number'));

        $branch->save();
      
        Session::put('msgsuccess', 'You have successfully edited branch.');
        return Redirect::to('/admin/branches');

    }

    
  }
 



  public function delete($branch_id)
  {

       $exist = Branch::where('id', $branch_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Failed to find branch.');
         return Redirect::back()->withInput();
      }

        
        $checkUsers = User::where("branch_id", $branch_id)->count();

        if($checkUsers!=0){
          Session::put('msgfail', 'Failed delete branch. Please assure that no employee is assigned to this branch.');
         return Redirect::back()->withInput();
        }

        Branch::where("id", $branch_id)->delete();
      
        Session::put('msgsuccess', 'Successfully deleted branch.');
       
        return Redirect::to("/admin/branches");

    
  }



 
}