@extends('layouts/main')

@section('title')
Iron Bank of the Philippines
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
                    Iron Bank Online Portal
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6" >
                          <?php 
                          $account = AccountEntry::where("user_id", Auth::user()->id)->where("account_id", 1)->first();
                          ?>
                         <h4>Savings Account</h4>
                         <br>
                         <div class="col-lg-6" >Balance:</div>
                         <div class="col-lg-6" >{{$account->balance}}</div>

                         
                        </div>
                        <div class="col-lg-6" >
                              <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Location</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                
                

            </tr>
        </thead>
        <tbody>


            @foreach($transactions as $transaction)

                <tr >
                    <td>
                         <?php
                        if($transaction->atm_id != 0)
                        {
                            $atm = ATM::find($transaction->atm_id);
                            echo $atm->address;

                        }
                        else if($transaction->staff_id!=0)
                        {

                            $staff = User::find($transaction->staff_id);
                            $branch = Branch::find($staff->branch_id);
                            echo $branch->address;
                        }
                        ?>
                        </td>
                  
                   
                    <td>
                        <?php 
                        $transactionInfo = Transaction::find($transaction->transaction_id);
                        echo $transactionInfo->type;
                        ?>
                      </td>
                    <td>{{ $transaction->amount}}</td>
                  
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



    </div>

@stop

@section('footer')
@stop