
@extends('layouts/simulate')



@section('main')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">

	  	<div class="container">
	  	
		   {{ Form::open(array('class' => 'form-login', 'role' => 'form')) }}
    
		        <h2 class="form-login-heading">ATM Balance Inquiry Simulation</h2>
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
                    <b style="color:white;">Balance </b>
                </div>
                <div class="modal-body">
                    <p style="color:black;">
                      <h5>The ATM Balance function is for inquiring the current balance of the account.</h5>
                      <br>
                      <h5>URL: http://domain.com/api/account/balance/access_key=<i>access_key</i></h5>
                      <br>
                      <h5>Method: POST</h5>
                      <br>
                      <h5>Inputs: { "card_id" => "<i>1</i>", "pincode" = "<i>1234</i>" }</h5>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>              
@stop