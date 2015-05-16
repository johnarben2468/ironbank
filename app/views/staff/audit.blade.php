
@extends('layouts.main')

@section('title')
    Audit Trail
@stop

@section('main')


<div class="row">
     @if(Session::get('msgsuccess'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgsuccess') }}</center>
      </div>
      {{ Session::forget('msgsuccess') }}
    @endif
    @if(Session::get('msgfail'))
      <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgfail') }}</center>
      </div>
      {{ Session::forget('msgfail') }}
    @endif
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Audit Trail
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Staff / ATM</th>
                <th>Account</th>
                <th>Transaction Type</th>

                <th>Amount</th>
                <th>Fee</th>
                
                

            </tr>
        </thead>
        <tbody>

     @if(Session::get('noresults'))
    <tr>
        <td colspan='6'>
        <center>{{ Session::get('noresults') }}</center>
        </td>
    </tr>
      {{ Session::forget('noresults') }}
    @endif

            @foreach($transactions as $transaction)


                <tr >
                    <td>
                         <?php
                        if($transaction->atm_id != 0)
                        {
                            $atm = ATM::find($transaction->atm_id);
                            echo $atm->name;

                        }
                        else if($transaction->staff_id!=0)
                        {
                            $staff = User::find($transaction->staff_id);
                            echo $staff->lastname.", ".$staff->firstname." ".$staff->middlename;
                        }
                        ?>
                        </td>
                  
                   <td>
                    <?php
                    $account = AccountEntry::find($transaction->account_entry_id);

                    ?>
                    {{$account->account_code}}
                   </td>
                    <td>
                        <?php 
                        $transactionInfo = Transaction::find($transaction->transaction_id);
                        echo $transactionInfo->type;
                        ?>
                      </td>
                    <td>{{ $transaction->amount}}</td>
                    <td>{{ $transactionInfo->fee}}</td>
                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $transactions->links(); }}</center>

  
    </div>

   
</div>
</div>
</div>
</div>
</div>
    
  
    </div>







@stop

@section('dialogs')

@stop