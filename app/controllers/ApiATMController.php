<?php
 

class ApiATMController extends ApiController {


  public function updateATM($access_key){

    $checkAccess = ATM::where('access_key', $access_key)->where('status',1 )->count();
    if($checkAccess==0){
      return $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
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
   
         return $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
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
     

     
        return $this->respond([
          'status' => 1,
          'message' => 'Successfully updated atm.',
          
        ]);

    }

  }
  public function changePin($access_key)
  {

    $checkAccess = ATM::where('access_key', $access_key)->where('status',1 )->count();
    if($checkAccess==0){
      return $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
    }
    
    $atm = ATM::where('access_key', $access_key)->first();


    $rules = array(
      'card_id'    => 'required|numeric',
      'pincode' => 'required|numeric',
      'new_pincode' => 'required|numeric',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
   
         return $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
    } 
    else {

      $exist = Card::where('id', Input::get('card_id'))->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to find card.',
          'data' => NULL
        ]); 
      }

      $exist = Card::where('id', Input::get('card_id'))->where('pincode', Input::get('pincode'))->where('status', 1)->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to access card.',
          'data' => NULL
        ]); 
      }


      $exist = AccountEntry::where('card_id', Input::get('card_id'))->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to find accbalance,
          );
     ount.',
          'data' => NULL
        ]); 
      }


       $entryLook = AccountEntry::where('card_id', Input::get('card_id'))->first();

       $card = Card::find($entryLook->card_id);

       $card->pincode = Input::get('new_pincode');

       $card->save();

        $dataArray[] = array(
          "balance" => $entryLook->balance,);
        return $this->respond([
          'status' => 1,
          'message' => 'Successfully changed pin code.',
          'data' => $dataArray,
        ]);

    }
  }
   public function balance($access_key)
  {

    $checkAccess = ATM::where('access_key', $access_key)->where('status',1 )->count();
    if($checkAccess==0){
      return $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
    }
    
    $atm = ATM::where('access_key', $access_key)->first();


    $rules = array(
      'card_id'    => 'required|numeric',
      'pincode' => 'required|numeric',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
   
         return $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
    } 
    else {

      $exist = Card::where('id', Input::get('card_id'))->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to find card.',
          'data' => NULL
        ]); 
      }

      $exist = Card::where('id', Input::get('card_id'))->where('pincode', Input::get('pincode'))->where('status', 1)->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to access card.',
          'data' => NULL
        ]); 
      }


      $exist = AccountEntry::where('card_id', Input::get('card_id'))->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to find account.',
          'data' => NULL
        ]); 
      }


       $entryLook = AccountEntry::where('card_id', Input::get('card_id'))->first();

        $dataArray[] = array(
          "balance" => $entryLook->balance,
          );
     
        return $this->respond([
          'status' => 1,
          'message' => 'Successfully viewed balance.',
          'data' => $dataArray,
        ]);

    }
  }


  public function withdraw($access_key)
  {

    $checkAccess = ATM::where('access_key', $access_key)->where('status',1 )->count();
    if($checkAccess==0){
      return $this->respond([
          'status' => 0,
          'message' => 'Access denied.',
          'data' => NULL
        ]);
    }
    
    $atm = ATM::where('access_key', $access_key)->first();


    $rules = array(
      'card_id'    => 'required|numeric',
      'pincode'	=> 'required|numeric',
      'amount'  => 'required|decimal',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
   
         return $this->respond([
          'status' => 0,
          'message' => 'Invalid input.',
          'data' => $validator->messages()
        ]);
    } 
    else {

      $exist = Card::where('id', Input::get('card_id'))->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to find card.',
          'data' => NULL
        ]); 
      }

      $exist = Card::where('id', Input::get('card_id'))->where('pincode', Input::get('pincode'))->where('status', 1)->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to access card.',
          'data' => NULL
        ]); 
      }


      $exist = AccountEntry::where('card_id', Input::get('card_id'))->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Failed to find account.',
          'data' => NULL
        ]); 
      }


      $transactionInfo = Transaction::where('type', 'Counter_Withdraw')->first();

      $exist = AccountEntry::where('card_id', Input::get('card_id'))->where('balance', '>', Input::get('amount')+$transactionInfo->fee)->count();

      if($exist == 0)
      {
         return $this->respond([
          'status' => 0,
          'message' => 'Current balance is insufficient.',
          'data' => NULL
        ]); 
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
      else if($vamount >= 200 && $denotwohundredpeso!=0)
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
          return $this->respond([
          'status' => 0,
          'message' => 'Failed to withdraw, denominations are invalid.',
          'data' => NULL
          ]); 
          }

          $atm->deno_onethousandpeso = $deno_onethousandpeso;
          $atm->deno_fivehundredpeso = $deno_fivehundredpeso;
          $atm->deno_twohundredpeso = $deno_twohundredpeso;
          $atm->deno_onehundredpeso = $deno_onehundredpeso;
          $atm->deno_fiftypeso = $deno_fiftypeso;
          $atm->deno_twentypeso = $deno_twentypeso;

          $atm->balance = $atm->balance - Input::get('amount');
          $atm->save();
     


       $entryLook = AccountEntry::where('card_id', Input::get('card_id'))->first();

        $entry = AccountEntry::find($entryLook->id);
        $entry->balance= $entry->balance - Input::get('amount');

        $accountInfo = Account::find($entry->account_id);
        if($entry->balance<$accountInfo->maintaining_bal)
        {          
        $entry->status = 0;
        }
        
        $entry->save();
       
        $transaction = new TransactionEntry;
        $transaction->account_entry_id = $entryLook->id;
        $transaction->staff_id = Auth::user()->id;
        $transaction->branch_id = Auth::user()->branch_id;
        $transaction->amount = Input::get('amount')-$transactionInfo->fee;
        $transaction->transaction_id = $transactionInfo->id;
        $transaction->save();


        $dataArray[] = array(
          "balance" => $entry->balance,
          );
     
        return $this->respond([
          'status' => 1,
          'message' => 'Successfully withdraw from account.',
          'data' => $dataArray,
        ]);

    }
  }
  
  
}