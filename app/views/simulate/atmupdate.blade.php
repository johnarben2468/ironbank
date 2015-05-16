
@extends('layouts/simulate')



@section('main')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">

	  	<div class="container">
	  	
		   {{ Form::open(array('class' => 'form-login', 'role' => 'form')) }}
    
		        <h2 class="form-login-heading">ATM Update Simulation</h2>
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

      <h5>
                 For testing purposes please input the access key of the ATM that you want to test.
        </h5><br>

    <div class="form-group @if ($errors->has('access_key')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">ATM Access Key</label>
            <div class="col-sm-10">
                <input name="access_key" type="access_key" class="form-control" placeholder="Access Key" maxlength="255">
           
                @if ($errors->has('access_key')) 
                    <p class="help-block">{{ $errors->first('access_key') }}</p> 
                @endif
        </div>
      </div>
      <br><br><br>
                <h5>
                This page simulates the admin function of refilling the cash in an ATM machine.
                </h5><br>
    	 <div class="form-group @if ($errors->has('deno_onethousandpeso')) has-error @endif">
         <label class="col-sm-6 col-sm-6 control-label">One Thousand Pesos</label>
            <div class="col-sm-6">
                {{ Form::number('deno_onethousandpeso', Session::get('deno_onethousandpeso'), array('class' => 'form-control', 'maxlength'=>'255')) }}
       
                @if ($errors->has('deno_onethousandpeso')) 
                    <p class="help-block">{{ $errors->first('deno_onethousandpeso') }}</p> 
                @endif
              </div>
        </div>
		    <br><br><br>
        <div class="form-group @if ($errors->has('deno_fivehundredpeso')) has-error @endif">
         <label class="col-sm-6 col-sm-6 control-label">Five Hundred Pesos</label>
            <div class="col-sm-6">
                {{ Form::number('deno_fivehundredpeso', Session::get('deno_fivehundredpeso'), array('class' => 'form-control', 'maxlength'=>'255')) }}
       
                @if ($errors->has('deno_fivehundredpeso')) 
                    <p class="help-block">{{ $errors->first('deno_fivehundredpeso') }}</p> 
                @endif
              </div>
        </div>
             <br><br><br>
        <div class="form-group @if ($errors->has('deno_twohundredpeso')) has-error @endif">
         <label class="col-sm-6 col-sm-6 control-label">Two Hundred Pesos</label>
            <div class="col-sm-6">
                {{ Form::number('deno_twohundredpeso', Session::get('deno_twohundredpeso'), array('class' => 'form-control', 'maxlength'=>'255')) }}
       
                @if ($errors->has('deno_twohundredpeso')) 
                    <p class="help-block">{{ $errors->first('deno_twohundredpeso') }}</p> 
                @endif
              </div>
        </div>
             <br><br><br>
         <div class="form-group @if ($errors->has('deno_onehundredpeso')) has-error @endif">
         <label class="col-sm-6 col-sm-6 control-label">One Hundred Pesos</label>
            <div class="col-sm-6">
                {{ Form::number('deno_onehundredpeso', Session::get('deno_onehundredpeso'), array('class' => 'form-control', 'maxlength'=>'255')) }}
       
                @if ($errors->has('deno_onehundredpeso')) 
                    <p class="help-block">{{ $errors->first('deno_onehundredpeso') }}</p> 
                @endif
              </div>
        </div>
             <br><br><br>
         <div class="form-group @if ($errors->has('deno_fiftypeso')) has-error @endif">
         <label class="col-sm-6 col-sm-6 control-label">Fifty Pesos</label>
            <div class="col-sm-6">
                {{ Form::text('deno_fiftypeso', Session::get('deno_fiftypeso'), array('class' => 'form-control', 'maxlength'=>'255')) }}
       
                @if ($errors->has('deno_fiftypeso')) 
                    <p class="help-block">{{ $errors->first('deno_fiftypeso') }}</p> 
                @endif
              </div>
        </div>
             <br><br><br>
        <div class="form-group @if ($errors->has('deno_twentypeso')) has-error @endif">
         <label class="col-sm-6 col-sm-6 control-label">Twenty Pesos</label>
            <div class="col-sm-6">
                {{ Form::number('deno_twentypeso', Session::get('deno_twentypeso'), array('class' => 'form-control', 'maxlength'=>'255')) }}
       
                @if ($errors->has('deno_twentypeso')) 
                    <p class="help-block">{{ $errors->first('deno_twentypeso') }}</p> 
                @endif
              </div>
        </div>
             <br><br><br>
      
		   
		            <br>
		            {{ Form::submit('Submit', ['class' => 'btn btn-theme btn-block']) }}
		           
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
                    <b style="color:white;">ATM Update </b>
                </div>
                <div class="modal-body">
                    <p style="color:black;">
                      <h5>The ATM Update function is an 
                      admin function for refilling the cash in an ATM machine. Updating the supply of cash to the system is for tracking and managing the cash supply in all atm machines.</h5>
                      <br>
                      <h5>URL: http://domain.com/api/atm/update/access_key=<i>access_key</i></h5>
                      <br>
                      <h5>Method: POST</h5>
                      <br>
                      <h5>Inputs: { "card_id" => "<i>1</i>", "pincode" = "<i>1234</i>"  }</h5>
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>              
@stop