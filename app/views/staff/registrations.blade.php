
@extends('layouts.main')

@section('title')
    Registrations
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
                    Registrations
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Name</th>
                <th>Accounts</th>
                <th>Contact Number</th>
                <th>Email</th>
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

            @foreach($users as $user)


                <tr >
                    <td>{{ $user->lastname.", ".$user->firstname." ".$user->middlename  }}</td>
                  
                    <td>{{ $user->note }}</td>
                    <td>{{ $user->contact_number }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="/staff/registrations/approve/{{$user->id}}">
                              <button class="btn btn-success" >Approve</button>
                        </a> 
                        <a href="/staff/registrations/decline/{{$user->id}}">
                              <button class="btn btn-warning" >Decline</button>
                        </a> 
                  
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $users->links(); }}</center>

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