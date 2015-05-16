
@extends('layouts/simulate')



@section('main')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
        {{Session::forget('saved_card_id')}}
               {{Session::forget('saved_pincode')}}
               {{Session::forget('saved_access_key')}}
               {{Session::forget('card_tried')}}
	  <div id="login-page">

	  	<div class="container">
	  	<div class ="row">
        <div class="col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    ATM API
                </div>
                <div class="panel-body">
                 
                
                <p>
                    The ATM API of the Iron Bank allows developers to create their own atm machine application while still utilizing the Iron Bank System. Utilizing the ATM API will require basic knowledge on how to use an API. 
                </p>



                       
                </div>
            </div>

        </div>
        </div >
        <div class ="row">
        <div class="col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Getting Started
                </div>
                <div class="panel-body"> 
                <div class="col-lg-4">       
                Using an admin account, add an ATM machine to get the access_key. Each ATM machine will use a unique access key to transact with the API.
                <br><br>
                Usage: 
                <br>
                Send your API request using the url syntax below.
                Note that domain.com stands for our current domain and endpoint stands for the subdomain of the function that you want to access. 
                <br>
                <h5>
                http://<i>domain.com</i>/api/<i>endpoint</i>?<font color="red">access_key=<i>1da10967aef18e74e</i></font>
                </h5>
                </div>
                 <div class="col-lg-8">  
                    <center>
                    {{ HTML::image('assets/img/1.png', 'Getting Started', array('width' => '100%', 'height' => '70%')) }}
                    </center>
                    <br>
                </div>
                   <br>


                </div>
            </div>
            
        </div>
        </div >
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
                    <b style="color:white;">API Info</b>
                </div>
                <div class="modal-body">
                  <b style="color:black;">
                    This page contains the general usage of the Iron Bank ATM API. The left side navigation contains the API features. Click on them to proceed. The API Info button when click in the said API feature page will display how to use the said API function.
          
                    </b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>              
@stop