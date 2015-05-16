<?php
 

 
class TransactionController extends BaseController {



  public function edit($id)
  {


      $exist = Transaction::where('id', $id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find transaction.');
         return Redirect::back();
      }

    $rules = array(
      
      'fee' => 'required|decimal',

      
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {

        $transaction = Transaction::find($id);
     
        $transaction->fee = strip_tags(Input::get('fee'));
    
        $transaction->save();

        
        Session::put('msgsuccess', 'Successfully edited transaction.');
       

        return Redirect::to('/admin/transactions');

    }
  }
 




  public function deposit()
  {  

    $rules = array(
      'account_code'    => 'required|numeric',
      'amount' => 'required|decimal',
      
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {
      
      $exist = AccountEntry::where('account_code', Input::get('account_code'))->where('status', 1)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Invalid account code.');
         return Redirect::back();
      }
      $entryLook = AccountEntry::where("account_code", Input::get('account_code'))->first();

        $account = AccountEntry::find($entryLook->id);
        
        $transactionInfo = Transaction::where('type', 'Counter_Deposit')->first();
        $account->balance = $account->balance+Input::get('amount') - $transactionInfo->fee;
      
        $account->save();

        $transaction = new TransactionEntry;
        $transaction->account_entry_id = $account->id;
        $transaction->staff_id = Auth::user()->id;
        $transaction->branch_id = Auth::user()->branch_id;
        $transaction->amount = Input::get('amount');
        $transaction->fee = $transactionInfo->fee;
        $transaction->transaction_id = $transactionInfo->id;

        $transaction->save();

        
        Session::put('msgsuccess', 'Successfully deposited to account.');
       

        return Redirect::to('/staff/deposit');

    }
  }
 




  public function withdraw()
  {  

    $rules = array(
      'account_code'    => 'required|numeric',
      'amount' => 'required|decimal',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {
      
      $exist = AccountEntry::where('account_code', Input::get('account_code'))->where('status', 1)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Invalid account code.');
         return Redirect::back();
      }
      $transactionInfo = Transaction::where('type', 'Counter_Withdraw')->first();
      $exist = AccountEntry::where('account_code', Input::get('account_code'))->where('balance', '>=', Input::get('amount')+$transactionInfo->fee)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Amount exceeds the balance.');
         return Redirect::back();
      }
      $entryLook = AccountEntry::where("account_code", Input::get('account_code'))->first();

        $account = AccountEntry::find($entryLook->id);
        $account->account_code = strip_tags(Input::get('account_code'));


        $account->balance = $account->balance-Input::get('amount')-$transactionInfo->fee;
        $accountInfo = Account::find($account->account_id);
        if($account->balance<$accountInfo->maintaining_bal)
        {          
        $account->status = 0;
        }
        
        $account->save();

        
        $transaction = new TransactionEntry;
        $transaction->account_entry_id = $account->id;
        $transaction->staff_id = Auth::user()->id;
        $transaction->branch_id = Auth::user()->branch_id;
        $transaction->amount = Input::get('amount');
        $transaction->fee = $transactionInfo->fee;
        $transaction->transaction_id = $transactionInfo->id;

        $transaction->save();

        Session::put('msgsuccess', 'Successfully withdrawed from account.');
       

        return Redirect::to('/staff/withdraw');

    }
  }
 

  public function transfer()
  {  

    $rules = array(
      'from_account_code'    => 'required|numeric',
      'to_account_code'    => 'required|numeric',
      'amount' => 'required|decimal',
    );

    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {
      
      $exist = AccountEntry::where('account_code', Input::get('from_account_code'))->where('status', 1)->orWhere('account_code', Input::get('to_account_code'))->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Invalid account code.');
         return Redirect::back();
      }
      $transactionInfo = Transaction::where('type', 'Counter_Transfer')->first();
      $exist = AccountEntry::where('account_code', Input::get('from_account_code'))->where('balance', '>=', Input::get('amount')+$transactionInfo->fee)->where('status', 1)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Amount exceeds the balance.');
         return Redirect::back();
      }
      
      $entryLook = AccountEntry::where("account_code", Input::get('from_account_code'))->first();

        $account = AccountEntry::find($entryLook->id);
  
        $account->balance = $account->balance-Input::get('amount')-$transactionInfo->fee;
        $accountInfo = Account::find($account->account_id);
        if($account->balance<$accountInfo->maintaining_bal)
        {          
        $account->status = 0;
        }
        
        $account->save();

        $entryLook = AccountEntry::where("account_code", Input::get('to_account_code'))->first();

        $account = AccountEntry::find($entryLook->id);

        $account->balance = $account->balance+Input::get('amount');
        $account->save();


        $transaction = new TransactionEntry;
        $transaction->account_entry_id = $account->id;
        $transaction->staff_id = Auth::user()->id;
        $transaction->branch_id = Auth::user()->branch_id;
        $transaction->amount = Input::get('amount');
        $transaction->fee = $transactionInfo->fee;
        $transaction->transaction_id = $transactionInfo->id;
        $transaction->save();

        Session::put('msgsuccess', 'Successfully transfered funds from account.');
       

        return Redirect::to('/staff/transfer');

    }
  }
 



}