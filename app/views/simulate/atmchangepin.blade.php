
@extends('layouts/simulate')



@section('main')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">

	  	<div class="container">
	  	
		   {{ Form::open(array('class' => 'form-login', 'role' => 'form')) }}
    
		        <h2 class="form-login-heading">ATM Change Pin Simulation</h2>
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
	
@if(Session::get('saved_card_id')&&Session::get('saved_pincode')&&Session::get('saved_access_key'))
       

    	 
      <div class="form-group @if ($errors->has('pincode')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Old Pincode</label>
            <div class="col-sm-10">
                <input name="pincode" type="password" class="form-control" placeholder="Old Pincode" maxlength="255">
           
                @if ($errors->has('pincode')) 
                    <p class="help-block">{{ $errors->first('pincode') }}</p> 
                @endif
        </div>
      </div>
      <br><br><br>

    
      <div class="form-group @if ($errors->has('newpincode')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">New Pincode</label>
            <div class="col-sm-10">
                <input name="newpincode" type="password" class="form-control" placeholder="New Pincode" maxlength="255">
           
                @if ($errors->has('newpincode')) 
                    <p class="help-block">{{ $errors->first('newpincode') }}</p> 
                @endif
        </div>
      </div>
      <br><br><br>
       

    
      <div class="form-group @if ($errors->has('newpincode_confirmation')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Confirm Pincode</label>
            <div class="col-sm-10">
                <input name="newpincode_confirmation" type="password" class="form-control" placeholder="Confirm Pincode" maxlength="255">
           
                @if ($errors->has('newpincode_confirmation')) 
                    <p class="help-block">{{ $errors->first('newpincode_confirmation') }}</p> 
                @endif
        </div>
      </div>
      <br><br><br>

       
       
        
		   
		            <br>
		            {{ Form::submit('Change', ['class' => 'btn btn-theme btn-block']) }}
		    @else
          <div class="alert alert-danger fade in" role="alert" align="center">Please insert your ATM card.</div>
        @endif
		            <hr>
		            <div class="registration">
		                This page is for simulation purposes of the ATM API functionalities of the Iron Bank.<br/>
		                <a class="" href="/">
		                    Return to the Main Portal
		                </a>
		            </div>
	  	
		        </div>
	
		     	  {{ Form::close() }}	
	  	
	  	</div>
	  </div>


@stop
@section('dialogs')
<?php
$modalName = "info";

?>
<div class="modal fade" id="{{ $modalName }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Change Pin </b>
                </div>
                <div class="modal-body">
                      <p style="color:black;">
                      <h5>The ATM Change function is for allowing the client to change his or her pincode on the ATM machine itself.</h5>
                      <br>
                      <h5>URL: http://domain.com/api/account/changepin/access_key=<i>access_key</i></h5>
                      <br>
                      <h5>Method: POST</h5>
                      <br>
                      <h5>Inputs: { "card_id" => "<i>1</i>", "pincode" = "<i>1234</i>", "new_pincode" = "<i>1111</i>"  }</h5>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>              
@stop