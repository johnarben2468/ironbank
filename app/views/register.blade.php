
@extends('layouts/external')



@section('main')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		   {{ Form::open(array('class' => 'form-login', 'role' => 'form')) }}
    
		        <h2 class="form-login-heading">Registration</h2>
		        <div class="login-wrap">

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
		       	

    	 <div class="form-group @if ($errors->has('firstname')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                {{ Form::text('firstname', Session::get('firstname'), array('class' => 'form-control', 'placeholder' => 'First Name','maxlength'=>'255')) }}
       
                @if ($errors->has('firstname')) 
                    <p class="help-block">{{ $errors->first('firstname') }}</p> 
                @endif
              </div>
        </div>
		         <br><br>
        <div class="form-group @if ($errors->has('middlename')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Middle Name</label>
            <div class="col-sm-10">
                {{ Form::text('middlename', Session::get('middlename'), array('class' => 'form-control', 'placeholder' => 'Middle Name','maxlength'=>'255')) }}
       
                @if ($errors->has('middlename')) 
                    <p class="help-block">{{ $errors->first('middlename') }}</p> 
                @endif
        </div>
      </div>
      <br><br>
        <div class="form-group @if ($errors->has('lastname')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Lastname</label>
            <div class="col-sm-10">
                {{ Form::text('lastname', Session::get('lastname'), array('class' => 'form-control', 'placeholder' => 'Lastname','maxlength'=>'255')) }}
       
                @if ($errors->has('lastname')) 
                    <p class="help-block">{{ $errors->first('lastname') }}</p> 
                @endif
        </div>
      </div>
      <br><br><br>
      <div class="form-group @if ($errors->has('address')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                {{ Form::text('address', Session::get('address'), array('class' => 'form-control', 'placeholder' => 'Address','maxlength'=>'255')) }}
       
                @if ($errors->has('address')) 
                    <p class="help-block">{{ $errors->first('address') }}</p> 
                @endif
              </div>
        </div>
        <br><br><br>
         <div class="form-group @if ($errors->has('contact_number')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Contact Number</label>
            <div class="col-sm-10">
                {{ Form::text('contact_number', Session::get('contact_number'), array('class' => 'form-control', 'placeholder' => 'Contact Number','maxlength'=>'255')) }}
       
                @if ($errors->has('contact_number')) 
                    <p class="help-block">{{ $errors->first('contact_number') }}</p> 
                @endif
              </div>
        </div>
        <br><br><br>
      <div class="form-group @if ($errors->has('email')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                {{ Form::email('email', Session::get('email'), array('class' => 'form-control', 'placeholder' => 'Email','maxlength'=>'255')) }}
       
                @if ($errors->has('email')) 
                    <p class="help-block">{{ $errors->first('email') }}</p> 
                @endif
              </div>
        </div>
        <br><br><br>
        <div class="form-group @if ($errors->has('password')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input name="password" type="password" class="form-control" placeholder="Password" maxlength="255">
           
                @if ($errors->has('password')) 
                    <p class="help-block">{{ $errors->first('password') }}</p> 
                @endif
        </div>
      </div>
      <br><br><br>

        <div class="form-group @if ($errors->has('password')) has-error @endif">
          <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
            <div class="col-sm-10">
                <input name="password_confirmation" type="password" class="form-control" placeholder="Retype Password" maxlength="255">
                 @if ($errors->has('password')) 
                    <p class="help-block">{{ $errors->first('password') }}</p> 
                @endif
              </div>

        </div>
        <br><br><br>
        
		     
        <div class="form-group @if ($errors->has('account')) has-error @endif">
              <label class="col-sm-2 col-sm-2 control-label">Accounts</label>
            <div class="col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="account[]" value="Savings">
                Savings
              </label>
              <label>
                <input type="checkbox" name="account[]" value="Time Deposit">
                Time Deposit
              </label>
            
              
              </div>
              @if ($errors->has('account')) 
                    <p class="help-block">{{ $errors->first('account') }}</p> 
              @endif
        </div>
      </div>
      <br><br><br>
		            <br>
		            {{ Form::submit('Register', ['class' => 'btn btn-theme btn-block']) }}
		           
		            <hr>
		            <div class="registration">
		                Already have an account?<br/>
		                <a class="" href="/login">
		                    Login Existing Account
		                </a>
		            </div>
	  	
		        </div>
	
		     	  {{ Form::close() }}	
	  	
	  	</div>
	  </div>


@stop
  