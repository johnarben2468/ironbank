
@extends('layouts.main')

@section('title')
    Edit Profile
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

    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Edit Profile
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      <div class="form-group @if ($errors->has('firstname')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                {{ Form::text('firstname', $user->firstname, array('class' => 'form-control', 'placeholder' => 'First Name','maxlength'=>'255')) }}
       
                @if ($errors->has('firstname')) 
                    <p class="help-block">{{ $errors->first('firstname') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('middlename')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Middle Name</label>
            <div class="col-sm-10">
                {{ Form::text('middlename', $user->middlename, array('class' => 'form-control', 'placeholder' => 'Middle Name','maxlength'=>'255')) }}
       
                @if ($errors->has('middlename')) 
                    <p class="help-block">{{ $errors->first('middlename') }}</p> 
                @endif
        </div>
    </div>
    <br><br>
                 
        <div class="form-group @if ($errors->has('lastname')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Lastname</label>
            <div class="col-sm-10">
                {{ Form::text('lastname', $user->lastname, array('class' => 'form-control  ', 'placeholder' => 'Lastname','maxlength'=>'255')) }}
  
            @if ($errors->has('lastname')) 
                <p class="help-block">{{ $errors->first('lastname') }}</p>  
            @endif
        </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('email')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                {{ Form::input('email','email', $user->email, array('class' => 'form-control', 'placeholder' => 'Email','maxlength'=>'255')) }}
       
                @if ($errors->has('email')) 
                    <p class="help-block">{{ $errors->first('email') }}</p> 
                @endif
        </div>
    </div>
         <br><br>          
        <div class="form-group @if ($errors->has('contact_number')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Contact Number</label>
            <div class="col-sm-10">
                {{ Form::text('contact_number', $user->contact_number, array('class' => 'form-control  ', 'placeholder' => 'Contact Number','maxlength'=>'255')) }}
  
            @if ($errors->has('contact_number')) 
                <p class="help-block">{{ $errors->first('contact_number') }}</p>  
            @endif
        </div>
        </div>
        <br>
        <br>

                   
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$user->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
