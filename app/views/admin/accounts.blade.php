
@extends('layouts.main')

@section('title')
    Accounts Management
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
                    Accounts Management
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Account Type</th>
                <th>Registration Fee</th>
                <th>Initial Deposit</th>
                <th>Maintaining Balance</th>
                <th>Interest Rate</th>
                <th>Interest Interval Days</th>
                <th>Action </th>

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

            @foreach($accounts as $account)


                <tr >
                    <td>{{ $account->type }}</td>
                  
                    <td>{{ $account->reg_fee }}</td>
                    <td>{{ $account->ini_dep }}</td>
                    <td>{{ $account->maintaining_bal }}</td>
                    <td>{{ $account->interest_rate }}</td>
                    <td>{{ $account->interest_interval_days }}</td>
                    <td>
                        <a href="/admin/accounts/edit/{{$account->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                      
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $accounts->links(); }}</center>

   
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