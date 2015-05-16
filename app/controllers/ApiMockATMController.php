<?php
 

class ApiMockATMController extends ApiController {


  public function atmupdate(){
    $access_key = Input::get('access_key');
    $checkAccess = ATM::where('access_key', $access_key)->where('status', 1)->count();
   
    if($checkAccess==0){


      $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
      Session::put('apiresult', $apiresult);

      Session::put('msgfail', 'Access denied.');
         return Redirect::back();
    }
    
    $atm = ATM::where('access_key', $access_key)->first();


    $rules = array(

        'deno_onethousandpeso' =>  'required|numeric',
        'deno_fivehundredpeso' =>  'required|numeric',
        'deno_twohundredpeso' =>   'required|numeric',
        'deno_onehundredpeso' =>    'required|numeric', 
        'deno_fiftypeso' =>         'required|numeric',
        'deno_twentypeso' =>        'required|numeric',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
   
         $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
Session::put('apiresult', $apiresult);
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

  
        $atm = ATM::find($atm->id);

  
          $atm->deno_onethousandpeso = Input::get("deno_onethousandpeso");
          $atm->deno_fivehundredpeso = Input::get("deno_fivehundredpeso");
          $atm->deno_twohundredpeso = Input::get("deno_twohundredpeso");
          $atm->deno_onehundredpeso = Input::get("deno_onehundredpeso");
          $atm->deno_fiftypeso = Input::get("deno_fiftypeso");
          $atm->deno_twentypeso = Input::get("deno_twentypeso");

          $atm->balance = 
          (Input::get("deno_onethousandpeso")*1000)
          +(Input::get("deno_fivehundredpeso")*500)
          +(Input::get("deno_twohundredpeso")*200)
          +(Input::get("deno_onehundredpeso")*100)
          +(Input::get("deno_fiftypeso")*50)
          +(Input::get("deno_twentypeso")*20);

          $atm->save();
     

     
        $apiresult = $this->respond([
          'status' => 1,
          'message' => 'Successfully updated atm.',
          
        ]);
Session::put('apiresult', $apiresult);

      Session::put('msgsuccess', 'Successfully updated atm.');
         return Redirect::back();

    }

  }

public function authentication()
  {
    $access_key = Input::get('access_key');

    $checkAccess = ATM::where('access_key', $access_key)->where('status', 1)->count();
    if($checkAccess==0){
      $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
      Session::put('apiresult', $apiresult);
       Session::put('msgfail', 'Access denied.');
         return Redirect::back()
          ->withInput(); 
    }
    
    $atm = ATM::where('access_key', $access_key)->first();


    $rules = array(
      'card_id'    => 'required|numeric',
      'pincode' => 'required|numeric',
    );

    if(!Session::get("card_tried")){

    Session::put("card_tried", Input::get('card_id'));
    Session::put("card_max", 0);
    }
    else{

      if(Session::get('card_max')==2){
        Session::put('msgfail', 'Maximum failed attempts has been reached. Please proceed to the counter to redeem your card.');
         return Redirect::back()
          ->withInput(); 
      }
      elseif(Input::get('card_id')==Session::get('card_tried'))
      {
        Session::put("card_tried", Input::get('card_id'));
        Session::put("card_max", Session::get('card_max')+1);
      }
      else{
        Session::put("card_tried", Input::get('card_id'));
        Session::put("card_max", 0);
      }
    }

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
   
         $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
         Session::put('apiresult', $apiresult);
            Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

      $exist = Card::where('id', Input::get('card_id'))->count();

      if($exist == 0)
      {

         $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Failed to find card.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
        Session::put('msgfail', 'Failed to find card.');
         return Redirect::back()->withInput(); 
      }

      $exist = Card::where('id', Input::get('card_id'))->where('pincode', Input::get('pincode'))->where('status', 1)->count();

      if($exist == 0)
      {
         $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Failed to access card.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
        Session::put('msgfail', 'Failed to access card.');
         return Redirect::back()->withInput(); 
      }


      $exist = AccountEntry::where('card_id', Input::get('card_id'))->where('status', 1)->count();

      if($exist == 0)
      {
         $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Failed to find account.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
        Session::put('msgfail', 'Failed to find account.');
         return Redirect::back()->withInput(); 
      }


       $entryLook = AccountEntry::where('card_id', Input::get('card_id'))->first();

        $dataArray[] = array(
          "balance" => $entryLook->balance,
          );
     
        $apiresult = $this->respond([
          'status' => 1,
          'message' => 'Card found.',
          'data' => $dataArray,
        ]);
        Session::put('apiresult', $apiresult);
        Session::put('saved_access_key', Input::get('access_key'));
        Session::put('saved_card_id', Input::get('card_id'));
        Session::put('saved_pincode', Input::get('pincode'));
         Session::put('msgsuccess', 'Card found.');
         return Redirect::back();

    }
  }

  public function changepin()
  {
    $access_key= Session::get('saved_access_key');
    $checkAccess = ATM::where('access_key', $access_key)->where('status', 1)->count();
    if($checkAccess==0){
      $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
      Session::put('apiresult', $apiresult);
         Session::put('msgfail', 'Access denied.');
         return Redirect::back()->withInput(); 
    }
    
    $atm = ATM::where('access_key', $access_key)->first();


    $rules = array(
  
      'pincode' => 'required|numeric',
      'newpincode_confirmation' => 'required||numeric',
      'newpincode' => 'required|confirmed',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
   
        $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
        Session::put('apiresult', $apiresult);
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

      $exist = Card::where('id', Session::get('saved_card_id'))->count();

      if($exist == 0)
      {
         $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Failed to find card.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
           Session::put('msgfail', 'Failed to find card.');
         return Redirect::back()
          ->withInput(); 
      }

      $exist = Card::where('id', Session::get('saved_card_id'))->where('pincode', Input::get('pincode'))->where('status', 1)->count();

      if($exist == 0)
      {
         $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Failed to access card.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
         Session::put('msgfail', 'Failed to access card.');
         return Redirect::back()
          ->withInput(); 
      }


      $exist = AccountEntry::where('card_id', Session::get('saved_card_id'))->count();

      if($exist == 0)
      {
         $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Failed to find account.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
         Session::put('msgfail', 'Failed to find account.');
         return Redirect::back()
          ->withInput(); 
      }


       $entryLook = AccountEntry::where('card_id', Session::get('saved_card_id'))->first();

       $card = Card::find($entryLook->card_id);

       $card->pincode = Input::get('newpincode');

       $card->save();

     
        $apiresult= $this->respond([
          'status' => 1,
          'message' => 'Successfully changed pin code.',
          'data' => null,
        ]);
Session::put('apiresult', $apiresult);

        Session::put('saved_pincode', Input::get('newpincode'));
        Session::put('msgsuccess', 'Successfully changed pin code.');
         return Redirect::back();
    }
  }




  public function withdraw()
  {
    $access_key = Session::get("saved_access_key");
    $checkAccess = ATM::where('access_key', $access_key)->where('status',1 )->count();
    if($checkAccess==0){

      $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
      Session::put('apiresult', $apiresult);
        Session::put('msgfail', 'Access denied.');
         return Redirect::back()
          ->withInput(); 
    }
    
    $atm = ATM::where('access_key', $access_key)->first();


    $rules = array(
    
      'pincode'	=> 'required|numeric',
      'amount'  => 'required|decimal',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
   
        $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
        Session::put('apiresult', $apiresult);

           Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

      $exist = Card::where('id', Session::get('saved_card_id'))->count();

      if($exist == 0)
      {
        $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Failed to find card.',
          'data' => NULL
        ]); 
        Session::put('apiresult', $apiresult);
         Session::put('msgfail', 'Failed to find card.');
         return Redirect::back()
          ->withInput(); 
      }

      $exist = Card::where('id', Session::get('saved_card_id'))->where('pincode', Input::get('pincode'))->where('status', 1)->count();

      if($exist == 0)
      {
         $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Failed to access card.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
         Session::put('msgfail', 'Failed to access card.');
         return Redirect::back()
          ->withInput(); 
      }


      $exist = AccountEntry::where('card_id', Session::get('saved_card_id'))->where('status',1)->count();

      if($exist == 0)
      {
        $apiresult=  $this->respond([
          'status' => 0,
          'message' => 'Failed to find account.',
          'data' => NULL
        ]); 
        Session::put('apiresult', $apiresult);
          Session::put('msgfail', 'Failed to find account.');
         return Redirect::back()
          ->withInput(); 
      }


      $transactionInfo = Transaction::where('type', 'ATM_Withdraw')->first();

      $exist = AccountEntry::where('card_id', Session::get('saved_card_id'))->where('balance', '>', Input::get('amount')+$transactionInfo->fee)->count();

      if($exist == 0)
      {
         $apiresult = $this->respond([
          'status' => 0,
          'message' => 'Current balance is insufficient.',
          'data' => NULL
        ]); 
         Session::put('apiresult', $apiresult);
          Session::put('msgfail', 'Current balance is insufficient.');
         return Redirect::back()
          ->withInput(); 
      }


      $vamount = Input::get('amount');      
     
      $atm = ATM::find($atm->id);

        $deno_onethousandpeso =  $atm->deno_onethousandpeso;
        $deno_fivehundredpeso =  $atm->deno_fivehundredpeso;
        $deno_twohundredpeso =  $atm->deno_twohundredpeso;
        $deno_onehundredpeso =  $atm->deno_onehundredpeso;
        $deno_fiftypeso =  $atm->deno_fiftypeso;
        $deno_twentypeso =  $atm->deno_twentypeso;

      while(1==1){

      if($vamount >= 1000 && $deno_onethousandpeso!=0)
      {   

        $vamount -= 1000;
        $deno_onethousandpeso -= 1;
      }
      else if($vamount >= 500 && $deno_fivehundredpeso!=0)
      {   

        $vamount -= 500;
        $deno_fivehundredpeso -= 1;
      }
      else if($vamount >= 200 && $deno_twohundredpeso!=0)
      {   

        $vamount -= 200;
        $deno_twohundredpeso -= 1;
      }
      else if($vamount >= 100 && $deno_onehundredpeso!=0)
      {   

        $vamount -= 100;
        $deno_onehundredpeso -= 1;
      }
      else if($vamount >= 50 && $deno_fiftypeso!=0)
      {   

        $vamount -= 50;
        $deno_fiftypeso -= 1;
      }
      else if($vamount >= 20 && $deno_twentypeso!=0)
      {   

        $vamount -= 20;
        $deno_twentypeso -= 1;
      }
      else
      {
        break;
      }
      }

          if($vamount!=0){
          $apiresult= $this->respond([
          'status' => 0,
          'message' => 'Failed to withdraw, denominations are invalid.',
          'data' => NULL
          ]); 
          Session::put('apiresult', $apiresult);
           Session::put('msgfail', 'Failed to withdraw, Please enter denominations available: 1000,500,100');
         return Redirect::back()
          ->withInput(); 
          }

          $atm->deno_onethousandpeso = $deno_onethousandpeso;
          $atm->deno_fivehundredpeso = $deno_fivehundredpeso;
          $atm->deno_twohundredpeso = $deno_twohundredpeso;
          $atm->deno_onehundredpeso = $deno_onehundredpeso;
          $atm->deno_fiftypeso = $deno_fiftypeso;
          $atm->deno_twentypeso = $deno_twentypeso;

          $atm->balance = $atm->balance - Input::get('amount');
          $atm->save();
     


       $entryLook = AccountEntry::where('card_id', Session::get('saved_card_id'))->first();

        $entry = AccountEntry::find($entryLook->id);
        $entry->balance= $entry->balance - Input::get('amount')-$transactionInfo->fee;
        $entry->save();
       
        $transaction = new TransactionEntry;
        $transaction->account_entry_id = $entryLook->id;
        $transaction->atm_id = $atm->id;
        $transaction->branch_id = 0;
        $transaction->amount = Input::get('amount');
        $transaction->fee = $transactionInfo->fee;
        $transaction->transaction_id = $transactionInfo->id;
        $transaction->save();


        $dataArray[] = array(
          "balance" => $entry->balance,
          );
     
        $apiresult= $this->respond([
          'status' => 1,
          'message' => 'Successfully withdraw from account.',
          'data' => $dataArray,
        ]);
        Session::put('apiresult', $apiresult);
           Session::put('msgsuccess', 'Successfully withdraw from account.');
         return Redirect::back(); 

    }
  }
  
  
}