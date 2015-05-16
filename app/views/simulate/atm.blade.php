
@extends('layouts/simulate')



@section('main')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">

	  	<div class="container">
	  	
		   {{ Form::open(array('class' => 'form-login', 'role' => 'form')) }}
    
		        <h2 class="form-login-heading">ATM Simulation</h2>
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
                  The card id is automatically detected by inserting an ATM card to the machine. For testing purposes the card id will be inputted for this webpage.
        </h5><br>
    	 <div class="form-group @if ($errors->has('card_id')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Card ID</label>
            <div class="col-sm-10">
                {{ Form::text('card_id', Session::get('card_id'), array('class' => 'form-control', 'placeholder' => 'Card ID','maxlength'=>'255')) }}
       
                @if ($errors->has('card_id')) 
                    <p class="help-block">{{ $errors->first('card_id') }}</p> 
                @endif
              </div>
        </div>
		         <br><br><br>
       
    
      <div class="form-group @if ($errors->has('pincode')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Pincode</label>
            <div class="col-sm-10">
                <input name="pincode" type="password" class="form-control" placeholder="Pincode" maxlength="255">
           
                @if ($errors->has('pincode')) 
                    <p class="help-block">{{ $errors->first('pincode') }}</p> 
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
                    <b style="color:white;">Authentication </b>
                </div>
                <div class="modal-body">
                    <p style="color:black;">
                      For our clients security the ATM API requires the card_id and pincode as an input for all api request that access our clients' data. 

                      <h5>Sample Inputs: { "card_id" => "<i>1</i>", "pincode" = "<i>1234</i>"  }</h5>

                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>              
@stop