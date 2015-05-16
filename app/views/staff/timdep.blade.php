
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
                   Time Deposit Accounts Management
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Owner</th>
              
                <th>Account Code</th>
                <th>Balance</th>
                <th>Status</th>
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
                    <td><?php
                    $user = User::find($account->user_id);
                    ?>
                    {{$user->lastname.", ".$user->firstname." ".$user->middlename}} 
    
                  
                    <td>{{ $account->account_code }}</td>
                    <td>{{ $account->balance }}</td>
                    <td>{{ $account->status}}</td>

                    <td>
                        @if($account->status==1)
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#deactivate_' . $account->id }}"  data-toggle="tooltip" data-placement="top"  title="Deactivate Staff">Deactivate</button>
                        @else
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="{{ '#activate_' . $account->id }}"  data-toggle="tooltip" data-placement="top"  title="Activate Staff">Activate</button>
                        @endif
               
                      
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
@foreach($accounts as $account)
    <?php 
        $modalName = "deactivate";
        $message = "Are you sure you want to deactivate this account ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $account->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Deactivate Account</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/staff/timdep/deactivate/{{$account->id}}" class="btn btn-warning" id="confirm">Deactivate </a>
                </div>
            </div>
        </div>
    </div>              

    <?php 
        $modalName = "activate";
        $message = "Are you sure you want to activate this account ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $account->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Activate Account</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/staff/timdep/activate/{{$account->id}}" class="btn btn-success" id="confirm">Activate </a>
                </div>
            </div>
        </div>
    </div>              
@endforeach
@stop